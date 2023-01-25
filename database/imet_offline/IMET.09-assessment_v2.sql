BEGIN;

DROP SCHEMA IF EXISTS imet_assessment_v2 CASCADE;
CREATE SCHEMA imet_assessment_v2;

--- TABLES



CREATE TABLE imet_assessment_v2.imet_rank_pval (
  id integer NOT NULL PRIMARY KEY,
  key integer,
  value_p double precision,
  item_classification text
);

CREATE TABLE imet_assessment_v2.imet_tables_raw (
  tid integer,
  phase text,
  itclass text,
  tn text,
  tjson text
);

INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (7, 4, 100, 'EVAL I4');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (8, 3, 83.299999999999997, 'EVAL I4');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (9, 2, 50, 'EVAL I4');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (10, 1, 16.699999999999999, 'EVAL I4');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (11, 2, 62.5, 'EVAL P3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (12, 1, 25, 'EVAL P3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (13, 4, 100, 'EVAL P3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (14, 3, 87.5, 'EVAL P3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (16, 0, 12.5, 'EVAL PR9');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (15, 1, 37.5, 'EVAL PR9');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (18, 2, 62.5, 'EVAL PR9');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (17, 3, 87.5, 'EVAL PR9');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (19, 4, 100, 'EVAL PR9');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (20, 0, 0, 'EVAL I3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (2, 2, 37.5, 'EVAL I3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (1, 1, 12.5, 'EVAL I3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (21, 5, 100, 'EVAL I3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (4, 4, 80, 'EVAL I3');
INSERT INTO imet_assessment_v2.imet_rank_pval VALUES (3, 3, 60, 'EVAL I3');


--- FUNCTIONS

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_metadata()
    RETURNS SETOF imet.imet_metadata
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE
    ROWS 1000
AS
$BODY$
BEGIN
    return query select * from imet.imet_metadata WHERE version = 'v2';
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_stat_labels(
)
  RETURNS TABLE(code text, code_label text, title_fr text, title_en text, title_sp text)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  sql text;

BEGIN

  sql:= 'SELECT code::text, code_label::text,title_fr::text,title_en::text,title_sp::text from imet.imet_metadata_statistics WHERE version=''v2'';';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_tables_data(
  tableid integer,
  qfields text DEFAULT NULL::text,
  where_c text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.imet_tables_raw
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  sql text;
  tablename text;
  tid integer;
  phase text;
  itclass text;
  qflds text;
  wherec text;
  schemaname text;
  selectable_f text;

BEGIN
  schemaname:= 'imet';

  tablename:= (
              SELECT quote_ident("db_table")
              FROM imet.imet_metadata WHERE version = 'v2' AND id=tableid
              );

  tid:= (
        SELECT id
        FROM imet.imet_metadata WHERE version = 'v2' AND id=tableid
        );

  phase:= (
          SELECT imet.imet_metadata.phase
          FROM imet.imet_metadata WHERE version = 'v2' AND id=tableid
          );

  itclass:= (
            SELECT code
            FROM imet.imet_metadata WHERE version = 'v2' AND id=tableid
            );

  selectable_f:= (
                 SELECT string_agg('c.'||quote_ident(column_name),',')
                 FROM information_schema.columns
                 WHERE table_schema = schemaname
                   AND table_name   = replace(tablename,'"','')
                   AND column_name not like '%_BYTEA'
                 );

  IF qfields IS NOT NULL and qfields!='' THEN
    qflds := qfields;
  ELSE qflds := selectable_f;
  END IF;

  IF where_c IS NOT NULL and where_c!='' THEN
    wherec := 'WHERE '||where_c;
  ELSE wherec := '';
  END IF;

  sql:= 'SELECT '||
        tid||','||
        quote_nullable(phase)||'::text,'||
        quote_nullable(itclass)||'::text,
        replace('||quote_nullable(tablename)||'::text,''"'','''') as tn,
        to_json(array_agg(row_to_json(t)))::text as tjson
        FROM
	(select
	b."wdpa_id",
	'||qflds||'
	FROM imet.imet_form b
	JOIN "'||schemaname||'".'||tablename||' c on b."FormID"=c."FormID"
	) as t '||
        wherec
        ||' ;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.imet_cm_i2_prep(
  form_id integer DEFAULT NULL::integer)
  RETURNS TABLE(formid integer, fun text, ratio03 numeric, w_avg numeric)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  wherec text;
  sql text;

BEGIN

  if form_id is not null
  then
    wherec:= 'where formid = '||form_id;
  else
    wherec:= '';
  end if;

  sql:= '
with tableratio as (
select "FormID" as formid,"Function" as fun,
"ExpectedPermanent" as exp_per,
"ActualPermanent" as act_per,
least(coalesce("ActualPermanent",0)/nullif("ExpectedPermanent",0),1) as ratio

from imet.context_management_staff)
, tableratio03 as(
    select
    a.formid,a.fun,
    a.exp_per, a.act_per,
    case when a.ratio=0 then 0
        when a.ratio>0 then ceil(a.ratio*4-1)
        else null::numeric
        end as ratio03
    from tableratio a),
tableratio03weight as(
    select b.formid,b.fun,b.exp_per,
    1+ln(nullif(b.exp_per,0)) as ln_exp_weight,
    b.act_per,b.ratio03,
    (b.ratio03*(1+ln(nullif(b.exp_per,0)))) as ratio_ln_exp_weight
    from
    tableratio03 b
    )

select c.formid,c.fun::text,
   c.ratio03::numeric,
   (c.ln_exp_weight)::numeric as w_avg
from tableratio03weight c ' || wherec ||';';

  RETURN QUERY EXECUTE sql;

END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_table_all(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,'
                                         ' AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'" where "'||field_value||'"!=(-99::numeric)
     group by "FormID") as avg_t GROUP BY formid order by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_table_all_2(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/2*100::float as value_p
     from
     (select "FormID" as formid,'
                                         ' AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'" where "'||field_value||'"!=(-99::numeric)
     group by "FormID") as avg_t GROUP BY formid order by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_table_all_4(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/4*100::float as value_p
     from
     (select "FormID" as formid,'
                                         ' AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'" where "'||field_value||'"!=(-99::numeric)
     group by "FormID") as avg_t GROUP BY formid order by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_rank_all(
  tablename text,
  field_value text,
  item_class text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql:= 'select a."FormID",'''||item_class||'''::text as section,b."value_p" from '||schemaname||'."'||
        tablename||
        '" a JOIN "imet_assessment_v2"."imet_rank_pval" b on a."'||
        field_value||
        '" = b."key" where b.item_classification='''||
        item_class||'''
      group by a."FormID",b."value_p"
       order by a."FormID";';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_group_all(
  item_class text,
  tablename text,
  field_value text,
  field_group_element text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,"'
         ||field_group_element||'"
     ,AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'"
     where "EvaluationScore" != -99
     group by "'||field_group_element||'" , "FormID") as avg_t GROUP BY formid order by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_group_all_fix(
  item_class text,
  tablename text,
  field_value text,
  field_group_element text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,"'
         ||field_group_element||'"
     ,AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'"
     where "'||field_value||'" != -99
     group by "'||field_group_element||'" , "FormID") as avg_t GROUP BY formid order by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c2(
        item_class text,
        tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'select "FormID",'''||item_class||'''::text as section ,

                (SUM("EvaluationScore"*"EvaluationScore2")
                /
                SUM( "EvaluationScore" ))*100/3::float as value_p

                from "'||schemaname||'"."'||tablename||'"

                where "EvaluationScore" is not null
                and "EvaluationScore" > -4
                and "EvaluationScore2" is not null and "EvaluationScore2">-4

                group by "FormID"
                order by "FormID"';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c3(
	item_class text,
	tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '

      with table_include as (

  select "FormID",
			"Aspect",
			"IncludeInStatistics"
			from imet.eval_menaces
			where "IncludeInStatistics"::int = 1

 ),table0 as (
			select
a."FormID" as formid,
a."Impact"*(-1)+4 as impact,
a."Extension"*(-1)+4 as extension,
a."Duration"*(-1)+4 as duration,
a."Probability"*(-1)+4 as probability,

((-0.75)*a."Trend" + 2.5) as trend,
a."group_key" as grpval,
			a."Value"

from "'||schemaname||'"."'||tablename||'" a
), tableprod as(
    select
    formid,
    grpval,
    impact,extension,duration,probability,trend,
    (SELECT count(*) AS count FROM ( VALUES (impact), (extension), (duration), (probability), (trend)) v(col) WHERE v.col IS NOT NULL) as notnullval,
    coalesce(impact,1)*coalesce(extension,1)*coalesce(duration,1)*coalesce(probability,1)*coalesce(trend,1) as product

    from table0),
tablepower as (
    select
        formid,
        grpval,
        4-power(product,(1/nullif(notnullval::double precision,0))) as npower

    from tableprod),

tableavgnpower as (
    select
       formid,
       grpval,
       -avg(npower) as npower_avg
    from tablepower
    group by grpval,formid
)
select
   formid as "FormID",'''||item_class||'''::text as section ,
   (avg(npower_avg)*100/3.0)::double precision as value_p
from
tableavgnpower
group by formid;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c12(
        item_class text,
        tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
  with tab0 as (
        select
        "FormID",
        case when "SignificativeClassification" is null then 0::int
        else "SignificativeClassification"::int
        end  as sign_c,
        "EvaluationScore" as score
             from "'||schemaname||'"."'||tablename||'"
)

select "FormID",'''||item_class||'''::text as section ,
             (SUM( (1+2*sign_c)*score) / SUM(1+2*sign_c))*100/3::float as value_p
             from tab0
             where score is not null and score >=0
             group by "FormID"
             order by "FormID"
                 ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c13(
	item_class text,
	tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
        with table1 as (
           select "FormID","EvaluationScore",
             case when "SignificativeSpecies" is null then 0::int
                  when "SignificativeSpecies" is not null then "SignificativeSpecies"::int
             end as "SignificativeSpecies",
			"IncludeInStatistics"::int as include
            from imet.eval_importance_c13
        )
         select "FormID",'''||item_class||'''::text as section ,
             (SUM( (1+2*"SignificativeSpecies"::int)*"EvaluationScore") / SUM(1+2*"SignificativeSpecies"::int))*100/3::float as value_p
             from table1
	     where "EvaluationScore" is not null and "EvaluationScore">=0 and include=1
	     group by "FormID"
	     order by "FormID"';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;


CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c14(
	item_class text,
	tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
     with table1 as (
           select "FormID","EvaluationScore",
             case when "EvaluationScore2" is null then 1::int
                  when "EvaluationScore2" is not null then "EvaluationScore2"::int
             end as "EvaluationScore2",
	        "IncludeInStatistics"::int as include
            from imet.eval_importance_c14
        )

     select "FormID",'''||item_class||'''::text as section ,
             (SUM( ("EvaluationScore2"::int)*"EvaluationScore") / nullif(SUM("EvaluationScore2"::int),0))*100/3::float as value_p
             from table1
	     where "EvaluationScore" is not null and "EvaluationScore">=0 and include=1
	     group by "FormID"
	     order by "FormID"';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c15(
	item_class text,
	tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
  with table1 as (
  select "FormID",
	case when "EvaluationScore"<0 then null
	else "EvaluationScore"
	end
	as score,
	"Aspect",
	"IncludeInStatistics"
	from imet.eval_importance_c16
	where "IncludeInStatistics"::int = 1
), table_w as (
  select "FormID",
	"Element",
	(coalesce("Importance",0.) + coalesce("ImportanceRegional"/3.,0.) + coalesce((2 - "ImportanceGlobal")/4.,0.))
	/ 3.0
	as weight
	from imet.context_ecosystem_services
)

select a."FormID",'''||item_class||'''::text as section,
 sum(coalesce(b.weight,0.) * coalesce(a.score/3.0,0.))/sum(coalesce(b.weight,0.))
 *100.0::double precision as value_p
from table1 a
join table_w b on b."FormID" = a."FormID" and a."Aspect" = b."Element"
 where score is not null
 group by a."FormID"
 order by a."FormID"
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_i2(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
  LANGUAGE 'plpgsql'

  COST 100
  VOLATILE
  ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '

with table0 as(
   select "FormID" as formid,
	"Function",
	nullif(sum("ActualPermanent"),0)/nullif(sum("ExpectedPermanent"),0) as ratio
	from imet.context_management_staff
	group by "Function","FormID"
),table1 as (
select
    a.formid,
	a."Function",
	case when ratio is null or b."StaffCapacityAdequacy" is null then 0
	else
	 ceil(ratio*5-1)*b."StaffCapacityAdequacy"
	end
	as eval_sc
from table0 a
join "'||schemaname||'"."'||tablename||'" b on b."FormID"=a.formid and a."Function" = b."Theme")

select
formid as "FormID", '''||item_class||'''::text as section ,
round(sum(a.eval_sc)/(12*count(a.eval_sc))*100,2)::double precision as value_p
from table1 a
  group by formid order by formid

     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_i5(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
     with table0 as(
    select
    "FormID" as formid,
    "group_key" as group_res,
    avg("AdequacyLevel") as ad_level

    from imet.context_equipments

    group by "group_key","FormID"
    order by "FormID"),

   table1 as(

       select a."FormID" as formid ,
b."Equipment" as equipment,
case when b."Importance" is not null then b."Importance"
     when b."Importance" is null then 1::numeric
     else null
     end as importance
from imet.imet_form a
left join "'||schemaname||'"."'||tablename||'" b on b."FormID"=a."FormID"

   ),table2 as (

   select
   a.formid,a.group_res,a.ad_level,
   coalesce(b.importance,0)+1 as imp_p1,
   a.ad_level*(coalesce(b.importance,0)+1) as eq_imp

   from table0 a
   left join table1 b on b.formid = a.formid and a.group_res = b.equipment
)

select c.formid,'''||item_class||'''::text as section ,
       (sum(eq_imp) / sum(imp_p1) *100/3)::double precision as value_p

from table2 c group by c.formid
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_oc2(
	item_class text,
	tablename text,
	field_value1 text,
	field_value2 text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
with table_pre as (
	select "FormID",
	"Condition",
	"Trend",
	group_key
	from imet."eval_key_conservation_trends"
	where "Condition"<>-99 and "Trend"<>-99
),table0 as (

	select "FormID" as formid,
	avg("'||field_value1||'")*100/3.0 as sum_cond,
	avg("'||field_value2||'")*100/3.0 as sum_trend,
	group_key
	from table_pre
	group by "FormID", group_key order by group_key

), table1 as(

	select formid,
	sum_cond,
	sum_trend,
	(sum_cond + sum_trend)/2.0 as g_avg,
	group_key
	from table0
)
select formid,'''||item_class||'''::text as section ,
  round( avg(g_avg) , 2)::double precision as value_p
  from table1 group by formid order by formid
     ;';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_op3(
  item_class text,
  tablename text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  sql text;

BEGIN
  sql := '

with table0 as (select

"FormID" as formid,
                                "Patrol" as patrol,
                                "RapidIntervention" as rapid,
                                "AirVehicles"::integer as airv,
                                "Planes"::integer as planes
                                 from imet."'||tablename||'"
                                )
select
formid ,'''||item_class||'''::text as section ,
100.0*((coalesce(patrol,0)+coalesce(rapid,0)+coalesce(airv,0)+coalesce(planes,0))::numeric
/
NULLIF(
3.0*(( SELECT count(*) AS count FROM ( VALUES (table0.patrol), (table0.rapid)) v(col)
          WHERE v.col IS NOT NULL))::double precision
+
(( SELECT count(*) AS count FROM ( VALUES (table0.airv), (table0.planes)) v(col)
          WHERE v.col IS NOT NULL))::double precision

        , 0::double precision)::numeric
)::double precision
as value_p
from table0
;
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_p3(
	item_class text,
	tablename text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'with table0 as (
	select "FormID" as formid, "Boundaries" as degree,
	case when "EvaluationScore" is null or "EvaluationScore"=-99 then 0.
	else "EvaluationScore"
	end
	as score from imet.eval_boundary_level_v2)
, table1 as (
   select "FormID" as formid, count("EvaluationScore") not_null from imet.eval_boundary_level_v2
	where "EvaluationScore" is not null
	group by "FormID"
)
select a.formid, '''||item_class||'''::text as section , (coalesce(avg(a.degree/6.0)*100/2.0,0) + sum(coalesce((a.score/3.0)*100,0)/2.)/b.not_null)::double precision  as value_p
 from table0 a
 join table1 b on a.formid=b.formid
group by a.formid,b.not_null
  ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr1(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
 with table0 as(
    select
    "FormID" as formid,
    "Theme" as theme,
    case when "EvaluationScore" is null then
              (select ratio03 from imet_assessment_v2.imet_cm_i2_prep("FormID") where fun = "Theme")
         when "EvaluationScore" is not null then "EvaluationScore"
         else null
    end as eval_score,
    "PercentageLevel" as perc_lev,
    case when "EvaluationScore" is null then
               (select w_avg from imet_assessment_v2.imet_cm_i2_prep("FormID") where fun = "Theme")
         when "EvaluationScore" is not null then 1
         else null
    end as weight
    from "'||schemaname||'"."'||tablename||'"
)
select
formid as "FormID",'''||item_class||'''::text as section ,
round( 100.0/6.0 * ((sum(weight * eval_score) + sum(weight * perc_lev))/sum(weight) )::numeric ,2 )::double precision as value_p
from table0
group by "FormID" order by "FormID";
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;


CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr6(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
  with table0 as (
	select
"FormID" as formid,
case when "EvaluationScore" = -99::numeric then null
	 when "EvaluationScore" is not null then "EvaluationScore" * "AdequacyLevel"
     end as num,

case when "EvaluationScore" = -99::numeric then null
	 when "EvaluationScore" is not null then "AdequacyLevel"
     end as den

from imet.eval_equipment_maintenance)

select
formid,
''P6''::text as section,
sum(num)/sum(coalesce(den,0))/3.0*100.0 ::double precision as value_p

from table0 group by formid;
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr7(
	item_class text,
	tablename text,
	field_value text,
	field_group_element text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := 'with table_include as (
   select * from imet."eval_management_activities"
	where "InManagementPlan"::int = 1
), table_0 as (
select "FormID" as formid,
	  AVG("EvaluationScore")as avg_g
     from table_include
     where "EvaluationScore" != -99 and "InManagementPlan"::int=1
	 group by "FormID"
)
select formid,'''||item_class||'''::text as section ,
avg_g/3.0*100::float as value_p from table_0';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr10(
	item_class text,
	tablename text,
	field_value text,
	field_group_element text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
  with table0 as (
 select "FormID" as formid,
	case
	  when "Cooperation"=-99 then 0
	else "Cooperation"
	end as score,
	coalesce("MPInvolvement",0) + coalesce("BAInvolvement",0)+ coalesce("EEInvolvement",0) + coalesce("MPIImplementation",0)
	  as weights,
	group_key

	from imet.eval_stakeholder_cooperation

), table1 as (
   select
   formid,
   sum( weights) as sw,
   sum( score/3.0 * weights )  as wi,
   group_key
	from table0 group by formid,group_key
), table2 as(
	select
   formid,
   ''PR10''::text as section,
	sum(wi)/ nullif(sum(sw),0)*100::double precision as value_p
	from table1
	group by formid
)
select * from table2
  ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr13(
  item_class text,
  tablename text,
  field_value text)
  RETURNS TABLE(formid integer, section text, value_p double precision)
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  --temporary sql to put fixed value..TODO
  sql := 'select "FormID",'''||item_class||'''::text as section , 43.3::double precision as value_p
     from "'||schemaname||'"."'||tablename||'"
     group by "FormID" order by "FormID";';

  sql:= '
     with table0 as(select

"FormID" as formid,
"Activity" as activity,
case when "EvaluationScore" = -99 then null
     when "EvaluationScore" is not null then "EvaluationScore"
     else null
end as eval,
1 as celem

from "'||schemaname||'"."'||tablename||'"
)

select formid as "FormID",'''||item_class||'''::text as section,
case when sum(celem)<5 then (sum(eval)/5)*100/3::double precision
     when sum(celem)>=5 then sum(eval)/sum(celem)*100/3::double precision
     else null::double precision
end as value_p
from table0
group by formid
     ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr18(
	item_class text,
	tablename text,
	field_value text,
	field_group_element text,
	field_group_element2 text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE
    ROWS 1000
AS $BODY$

declare
  schemaname text;
  sql text;

BEGIN
  schemaname:= 'imet';

  sql := '
with table0 as(
	select "FormID" as formid,
	nullif("EvaluationScore",-99) as score,
	group_key
	from imet.eval_ecosystem_services
), table3 as(
  select formid,
	''PR18''::text as section,
	avg(score)*100/3 :: double precision as value_p
	from table0 group by formid
)
select * from table3
  ';

  RETURN QUERY EXECUTE sql;
END;

$BODY$;

--- VIEWS

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_forms AS
  SELECT DISTINCT "FormID",
                  "Year",
                  wdpa_id,
                  "Country" AS iso3,
                  name
  FROM imet.imet_form
  ORDER BY "FormID", "Year";

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step1 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid,
            v_imet_forms."Year",
            v_imet_forms.wdpa_id,
            v_imet_forms.iso3,
            v_imet_forms.name
           FROM imet_assessment_v2.v_imet_forms
        ), table_c2 AS (
         SELECT get_imet_evaluation_stats_cm_c2.formid,
            get_imet_evaluation_stats_cm_c2.section,
            get_imet_evaluation_stats_cm_c2.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c2('C2'::text, 'eval_supports_and_constaints'::text) get_imet_evaluation_stats_cm_c2(formid, section, value_p)
        ), table_c3 AS (
         SELECT get_imet_evaluation_stats_cm_c3.formid,
            get_imet_evaluation_stats_cm_c3.section,
            get_imet_evaluation_stats_cm_c3.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c3('C3'::text, 'context_menaces_pressions'::text) get_imet_evaluation_stats_cm_c3(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_c12.formid,
            get_imet_evaluation_stats_cm_c12.section,
            get_imet_evaluation_stats_cm_c12.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c12('C1.1'::text, 'eval_importance_c12'::text) get_imet_evaluation_stats_cm_c12(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_cm_c13.formid,
            get_imet_evaluation_stats_cm_c13.section,
            get_imet_evaluation_stats_cm_c13.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c13('C1.2'::text, 'eval_importance_c13'::text) get_imet_evaluation_stats_cm_c13(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_cm_c14.formid,
            get_imet_evaluation_stats_cm_c14.section,
            get_imet_evaluation_stats_cm_c14.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c14('C1.3'::text, 'eval_importance_c14'::text) get_imet_evaluation_stats_cm_c14(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('C1.4'::text, 'eval_importance_c15'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table6 AS (
         SELECT get_imet_evaluation_stats_cm_c15.formid,
            get_imet_evaluation_stats_cm_c15.section,
            get_imet_evaluation_stats_cm_c15.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c15('C1.5'::text, 'eval_importance_c16'::text) get_imet_evaluation_stats_cm_c15(formid, section, value_p)
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(((COALESCE(c.value_p, 0::double precision) + COALESCE(d.value_p, 0::double precision) + COALESCE(e.value_p, 0::double precision) + COALESCE(f.value_p, 0::double precision) + COALESCE(g.value_p, 0::double precision)) / NULLIF((( SELECT count(*) AS count
                   FROM ( VALUES (c.value_p), (d.value_p), (e.value_p), (f.value_p), (g.value_p)) v(col)
                  WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 2) AS c1,
            round(c2.value_p::numeric, 2) AS c2,
            round(c3.value_p::numeric, 2) AS c3,
            round(c.value_p::numeric, 2) AS c11,
            round(d.value_p::numeric, 2) AS c12,
            round(e.value_p::numeric, 2) AS c13,
            round(f.value_p::numeric, 2) AS c14,
            round(g.value_p::numeric, 2) AS c15
           FROM table0 a
             LEFT JOIN table_c2 c2 ON a.formid = c2.formid
             LEFT JOIN table_c3 c3 ON a.formid = c3.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.c1,
    tableall.c2,
    tableall.c3,
    tableall.c11,
    tableall.c12,
    tableall.c13,
    tableall.c14,
    tableall.c15,
    round(((COALESCE(tableall.c1, 0::numeric) + COALESCE(tableall.c2 / 2.0 + 50.0, 0::numeric) + COALESCE(tableall.c3 + 100.0, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (tableall.c1), (tableall.c2), (tableall.c3)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM tableall
  ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step2 AS
WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid,
            v_imet_forms."Year",
            v_imet_forms.wdpa_id,
            v_imet_forms.iso3,
            v_imet_forms.name
           FROM imet_assessment_v2.v_imet_forms
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P1'::text, 'eval_regulations_adequacy'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P2'::text, 'eval_design_adequacy'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_cm_p3.formid,
            get_imet_evaluation_stats_cm_p3.section,
            get_imet_evaluation_stats_cm_p3.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_p3('EVAL P3'::text, 'eval_boundary_level_v2'::text) get_imet_evaluation_stats_cm_p3(formid, section, value_p)
        ), table4 AS (
         SELECT eval_management_plan."FormID" AS formid,
            'P4' AS section,
            100.0 * ((eval_management_plan."PlanExistence"::integer + eval_management_plan."PlanUptoDate"::integer + eval_management_plan."PlanApproved"::integer + eval_management_plan."PlanImplemented"::integer)::numeric + eval_management_plan."VisionAdequacy" + eval_management_plan."PlanAdequacyScore") / 10.0 AS value_p
           FROM imet.eval_management_plan
        ), table5 AS (
         SELECT eval_work_plan."FormID" AS formid,
            'P5' AS section,
            100.0 * ((eval_work_plan."PlanExistence"::integer + eval_work_plan."PlanUptoDate"::integer + eval_work_plan."PlanApproved"::integer + eval_work_plan."PlanImplemented"::integer)::numeric + eval_work_plan."VisionAdequacy" + eval_work_plan."PlanAdequacyScore") / 10.0 AS value_p
           FROM imet.eval_work_plan
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P6'::text, 'eval_objectives'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS p1,
            round(c.value_p::numeric, 2) AS p2,
            round(d.value_p::numeric, 2) AS p3,
            round(e.value_p, 2) AS p4,
            round(f.value_p, 2) AS p5,
            round(g.value_p::numeric, 2) AS p6
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.p1,
    tableall.p2,
    tableall.p3,
    tableall.p4,
    tableall.p5,
    tableall.p6,
    round(((COALESCE(tableall.p1 , 0::numeric) + COALESCE(tableall.p2 , 0::numeric) + COALESCE(tableall.p3, 0::numeric) + COALESCE(tableall.p4, 0::numeric) + COALESCE(tableall.p5, 0::numeric) + COALESCE(tableall.p6 , 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (tableall.p1), (tableall.p2), (tableall.p3), (tableall.p4), (tableall.p5), (tableall.p6)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM tableall
  ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step3 AS
  WITH table0 AS (
      SELECT v_imet_forms."FormID" AS formid,
             v_imet_forms."Year",
             v_imet_forms.wdpa_id,
             v_imet_forms.iso3,
             v_imet_forms.name
      FROM imet_assessment_v2.v_imet_forms
  ), table1 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('EVAL I1'::text, 'eval_information_availability'::text, 'EvaluationScore'::text, 'group_key'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table2 AS (
      SELECT get_imet_evaluation_stats_cm_i2.formid,
             get_imet_evaluation_stats_cm_i2.section,
             get_imet_evaluation_stats_cm_i2.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i2('EVAL I2'::text, 'eval_staff'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_cm_i2(formid, section, value_p)
  ), table3 AS (
      SELECT get_imet_evaluation_stats_rank_all.formid,
             get_imet_evaluation_stats_rank_all.section,
             get_imet_evaluation_stats_rank_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_rank_all('eval_budget_adequacy'::text, 'EvaluationScore'::text, 'EVAL I3'::text) get_imet_evaluation_stats_rank_all(formid, section, value_p)
  ), table4 AS (
      SELECT eval_budget_securization."FormID" AS formid,
             'EVAL I4' AS section,
             (eval_budget_securization."Percentage" / 5::numeric + eval_budget_securization."EvaluationScore" / 3::numeric) / 2::numeric * 100.0 AS value_p
      FROM imet.eval_budget_securization
  ), table5 AS (
      SELECT get_imet_evaluation_stats_cm_i5.formid,
             get_imet_evaluation_stats_cm_i5.section,
             get_imet_evaluation_stats_cm_i5.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i5('EVAL I5'::text, 'eval_management_equipment_adequacy'::text, 'Importance'::text) get_imet_evaluation_stats_cm_i5(formid, section, value_p)
  ), tableall AS (
      SELECT a.formid,
             a.wdpa_id,
             a.iso3,
             a.name,
             round(b.value_p::numeric, 2) AS i1,
             round(c.value_p::numeric, 2) AS i2,
             round(d.value_p::numeric, 2) AS i3,
             round(e.value_p, 2) AS i4,
             round(f.value_p::numeric, 2) AS i5
      FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
      ORDER BY a.formid
  )
  SELECT DISTINCT tableall.formid,
                  tableall.wdpa_id,
                  tableall.iso3,
                  tableall.name,
                  tableall.i1,
                  tableall.i2,
                  tableall.i3,
                  tableall.i4,
                  tableall.i5,
                  round(((COALESCE(tableall.i1, 0::numeric) + COALESCE(tableall.i2, 0::numeric) + COALESCE(tableall.i3, 0::numeric) + COALESCE(tableall.i4, 0::numeric) + COALESCE(tableall.i5, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                          FROM ( VALUES (tableall.i1), (tableall.i2), (tableall.i3), (tableall.i4), (tableall.i5)) v(col)
                                                                                                                                                                                                                                          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
  FROM tableall
  ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step4 AS
  WITH table0 AS (
      SELECT v_imet_forms."FormID" AS formid,
             v_imet_forms."Year",
             v_imet_forms.wdpa_id,
             v_imet_forms.iso3,
             v_imet_forms.name
      FROM imet_assessment_v2.v_imet_forms
  ), table1 AS (
      SELECT get_imet_evaluation_stats_cm_pr1.formid,
             get_imet_evaluation_stats_cm_pr1.section,
             get_imet_evaluation_stats_cm_pr1.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr1('PR1'::text, 'eval_staff_competence'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_cm_pr1(formid, section, value_p)
  ), table2 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR2'::text, 'eval_hr_management_politics'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table3 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR3'::text, 'eval_hr_management_systems'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table4 AS (
      SELECT eval_governance_leadership."FormID" AS formid,
             'PR4' AS section,
             (eval_governance_leadership."EvaluationScoreGovernace" + eval_governance_leadership."EvaluationScoreLeadership") / 6.0 * 100.0 AS value_p
      FROM imet.eval_governance_leadership
  ), table5 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all_4('PR5'::text, 'eval_administrative_management'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table6 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr6('PR6'::text, 'eval_equipment_maintenance'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table7 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('PR7'::text, 'eval_management_activities'::text, 'EvaluationScore'::text, 'group_key'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table8 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR8'::text, 'eval_law_enforcement_implementation'::text, 'Adequacy'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table9 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix('PR9'::text, 'eval_intelligence_implementation'::text, 'Adequacy'::text, 'group_key'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table10 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr10('PR10'::text, 'eval_stakeholder_cooperation'::text, 'Cooperation'::text, 'group_key'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table11 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix('PR11'::text, 'eval_assistance_activities'::text, 'EvaluationScore'::text, 'group_key'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table12 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR12'::text, 'eval_actors_relations'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table13 AS (
      SELECT get_imet_evaluation_stats_cm_pr13.formid,
             get_imet_evaluation_stats_cm_pr13.section,
             get_imet_evaluation_stats_cm_pr13.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR13'::text, 'eval_visitors_management'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_cm_pr13(formid, section, value_p)
  ), table14 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR14'::text, 'eval_visitors_impact'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table15 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR15'::text, 'eval_natural_resources_monitoring'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), table16 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR16'::text, 'eval_research_and_monitoring'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table17 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR17'::text, 'eval_climate_change_monitoring'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table18 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr18('PR18'::text, 'eval_ecosystem_services'::text, 'EvaluationScore'::text, 'group_key'::text, 'spam'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), tableall AS (
      SELECT a.formid,
             a.wdpa_id,
             a.iso3,
             a.name,
             round(b.value_p::numeric, 2) AS pr1,
             round(c.value_p::numeric, 2) AS pr2,
             round(d.value_p::numeric, 2) AS pr3,
             round(e.value_p, 2) AS pr4,
             round(f.value_p::numeric, 2) AS pr5,
             round(g.value_p::numeric, 2) AS pr6,
             round(h.value_p::numeric, 2) AS pr7,
             round(i.value_p::numeric, 2) AS pr8,
             round(j.value_p::numeric, 2) AS pr9,
             round(k.value_p::numeric, 2) AS pr10,
             round(l.value_p::numeric, 2) AS pr11,
             round(m.value_p::numeric, 2) AS pr12,
             round(n.value_p::numeric, 2) AS pr13,
             round(o.value_p::numeric, 2) AS pr14,
             round(p.value_p::numeric, 2) AS pr15,
             round(q.value_p::numeric, 2) AS pr16,
             round(r.value_p::numeric, 2) AS pr17,
             round(s.value_p::numeric, 2) AS pr18
      FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
             LEFT JOIN table7 h ON a.formid = h.formid
             LEFT JOIN table8 i ON a.formid = i.formid
             LEFT JOIN table9 j ON a.formid = j.formid
             LEFT JOIN table10 k ON a.formid = k.formid
             LEFT JOIN table11 l ON a.formid = l.formid
             LEFT JOIN table12 m ON a.formid = m.formid
             LEFT JOIN table13 n ON a.formid = n.formid
             LEFT JOIN table14 o ON a.formid = o.formid
             LEFT JOIN table15 p ON a.formid = p.formid
             LEFT JOIN table16 q ON a.formid = q.formid
             LEFT JOIN table17 r ON a.formid = r.formid
             LEFT JOIN table18 s ON a.formid = s.formid
      ORDER BY a.formid
  )
  SELECT DISTINCT tableall.formid,
                  tableall.wdpa_id,
                  tableall.iso3,
                  tableall.name,
                  tableall.pr1,
                  tableall.pr2,
                  tableall.pr3,
                  tableall.pr4,
                  tableall.pr5,
                  tableall.pr6,
                  tableall.pr7,
                  tableall.pr8,
                  tableall.pr9,
                  tableall.pr10,
                  tableall.pr11,
                  tableall.pr12,
                  tableall.pr13,
                  tableall.pr14,
                  tableall.pr15,
                  tableall.pr16,
                  tableall.pr17,
                  tableall.pr18,
                  round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                    FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6)) v(col)
                                                                                                                                                                                                                                                                                    WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS pr1_6,
                  round(((COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                     FROM ( VALUES (tableall.pr7), (tableall.pr8), (tableall.pr9)) v(col)
                                                                                                                                                                     WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr7_9,
                  round(((COALESCE(tableall.pr10, 0::numeric) + COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                        FROM ( VALUES (tableall.pr10), (tableall.pr11), (tableall.pr12)) v(col)
                                                                                                                                                                        WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr10_12,
                  round(((COALESCE(tableall.pr13, 0::numeric) + COALESCE(tableall.pr14, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                  FROM ( VALUES (tableall.pr13), (tableall.pr14)) v(col)
                                                                                                                                  WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr13_14,
                  round(((COALESCE(tableall.pr15, 0::numeric) + COALESCE(tableall.pr16, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                  FROM ( VALUES (tableall.pr15), (tableall.pr16)) v(col)
                                                                                                                                  WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr15_16,
                  round(((COALESCE(tableall.pr17, 0::numeric) + COALESCE(tableall.pr18, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                  FROM ( VALUES (tableall.pr17), (tableall.pr18)) v(col)
                                                                                                                                  WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr17_18,
                  round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric) + COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric) + COALESCE(tableall.pr10, 0::numeric) + COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric) + COALESCE(tableall.pr13, 0::numeric) + COALESCE(tableall.pr14, 0::numeric) + COALESCE(tableall.pr15, 0::numeric) + COALESCE(tableall.pr16, 0::numeric) + COALESCE(tableall.pr17, 0::numeric) + COALESCE(tableall.pr18, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6), (tableall.pr7), (tableall.pr8), (tableall.pr9), (tableall.pr10), (tableall.pr11), (tableall.pr12), (tableall.pr13), (tableall.pr14), (tableall.pr15), (tableall.pr16), (tableall.pr17), (tableall.pr18)) v(col)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
  FROM tableall;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step5 AS
  WITH table0 AS (
      SELECT v_imet_forms."FormID" AS formid,
             v_imet_forms."Year",
             v_imet_forms.wdpa_id,
             v_imet_forms.iso3,
             v_imet_forms.name
      FROM imet_assessment_v2.v_imet_forms
  ), table1 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/P1'::text, 'eval_work_program_implementation'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table2 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/P2'::text, 'eval_achieved_results'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table3 AS (
      SELECT get_imet_evaluation_stats_cm_op3.formid,
             get_imet_evaluation_stats_cm_op3.section,
             get_imet_evaluation_stats_cm_op3.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_op3('O/P3'::text, 'eval_area_domination'::text) get_imet_evaluation_stats_cm_op3(formid, section, value_p)
  ), tableall AS (
      SELECT a.formid,
             a.wdpa_id,
             a.iso3,
             a.name,
             round(b.value_p::numeric, 2) AS op1,
             round(c.value_p::numeric, 2) AS op2,
             round(d.value_p::numeric, 2) AS op3
      FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
      ORDER BY a.formid
  )
  SELECT DISTINCT tableall.formid,
                  tableall.wdpa_id,
                  tableall.iso3,
                  tableall.name,
                  tableall.op1,
                  tableall.op2,
                  tableall.op3,
                  round(((COALESCE(tableall.op1, 0::numeric) + COALESCE(tableall.op2, 0::numeric) + COALESCE(tableall.op3, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                     FROM ( VALUES (tableall.op1), (tableall.op2), (tableall.op3)) v(col)
                                                                                                                                                                     WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
  FROM tableall;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step6 AS
  WITH table0 AS (
      SELECT v_imet_forms."FormID" AS formid,
             v_imet_forms."Year",
             v_imet_forms.wdpa_id,
             v_imet_forms.iso3,
             v_imet_forms.name
      FROM imet_assessment_v2.v_imet_forms
  ), table1 AS (
      SELECT get_imet_evaluation_stats_table_all.formid,
             get_imet_evaluation_stats_table_all.section,
             get_imet_evaluation_stats_table_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/C1'::text, 'eval_achived_objectives'::text, 'EvaluationScore'::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
  ), table2 AS (
      SELECT get_imet_evaluation_stats_cm_oc2.formid,
             get_imet_evaluation_stats_cm_oc2.section,
             get_imet_evaluation_stats_cm_oc2.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_cm_oc2('O/C2'::text, 'eval_key_conservation_trends'::text, 'Condition'::text, 'Trend'::text) get_imet_evaluation_stats_cm_oc2(formid, section, value_p)
  ), table3 AS (
      SELECT get_imet_evaluation_stats_group_all.formid,
             get_imet_evaluation_stats_group_all.section,
             get_imet_evaluation_stats_group_all.value_p
      FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('O/C3'::text, 'eval_life_quality_impact'::text, 'EvaluationScore'::text, 'group_key'::text) get_imet_evaluation_stats_group_all(formid, section, value_p)
  ), tableall AS (
      SELECT a.formid,
             a.wdpa_id,
             a.iso3,
             a.name,
             round(b.value_p::numeric, 2) AS oc1,
             round(c.value_p::numeric, 2) AS oc2,
             round(d.value_p::numeric, 2) AS oc3
      FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
      ORDER BY a.formid
  )
  SELECT DISTINCT tableall.formid,
                  tableall.wdpa_id,
                  tableall.iso3,
                  tableall.name,
                  tableall.oc1,
                  tableall.oc2,
                  tableall.oc3,
                  round(((COALESCE(tableall.oc1, 0::numeric)::double precision + COALESCE(tableall.oc2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.oc3::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                     FROM ( VALUES (tableall.oc1), (tableall.oc2), (tableall.oc3)) v(col)
                                                                                                                                                                                                                                                                                                                     WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
  FROM tableall;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step_summary AS
  WITH table0 AS (
      SELECT v_imet_forms."FormID" AS formid,
             v_imet_forms."Year" AS year,
             v_imet_forms.wdpa_id,
             v_imet_forms.iso3,
             v_imet_forms.name
      FROM imet_assessment_v2.v_imet_forms
  ), table1 AS (
      SELECT v_imet_eval_stat_step1.formid,
             v_imet_eval_stat_step1.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step1
  ), table2 AS (
      SELECT v_imet_eval_stat_step2.formid,
             v_imet_eval_stat_step2.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step2
  ), table3 AS (
      SELECT v_imet_eval_stat_step3.formid,
             v_imet_eval_stat_step3.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step3
  ), table4 AS (
      SELECT v_imet_eval_stat_step4.formid,
             v_imet_eval_stat_step4.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step4
  ), table5 AS (
      SELECT v_imet_eval_stat_step5.formid,
             v_imet_eval_stat_step5.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step5
  ), table6 AS (
      SELECT v_imet_eval_stat_step6.formid,
             v_imet_eval_stat_step6.avg_indicator
      FROM imet_assessment_v2.v_imet_eval_stat_step6
  ), tableall AS (
      SELECT a.formid,
             a.wdpa_id,
             a.year,
             a.iso3,
             a.name,
             b.avg_indicator AS context,
             c.avg_indicator AS planning,
             d.avg_indicator AS inputs,
             e.avg_indicator AS process,
             f.avg_indicator AS outputs,
             g.avg_indicator AS outcomes
      FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
      ORDER BY a.formid
  )
  SELECT DISTINCT tableall.formid,
                  tableall.wdpa_id,
                  tableall.year,
                  tableall.iso3,
                  tableall.name,
                  tableall.context,
                  tableall.planning,
                  tableall.inputs,
                  tableall.process,
                  tableall.outputs,
                  tableall.outcomes
  FROM tableall;

--- FUNCTIONS calling views

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step1(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step1
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step1 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step1 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step1 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step1;
  END CASE;
END;


$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step2(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step2
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step2 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step2 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step2 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step2;
  END CASE;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step3(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step3
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step3 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step3 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step3 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step3;
  END CASE;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step4(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step4
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step4 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step4 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step4 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step4;
  END CASE;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step5(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step5
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step5 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step5 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step5 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step5;
  END CASE;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step6(
  form_id integer DEFAULT NULL::integer,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step6
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

BEGIN

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step6 where formid=form_id;
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step6 where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step6 where iso3=c_iso3 and formid=form_id;
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step6;
  END CASE;
END;

$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_summary(
  form_id text DEFAULT NULL::text,
  c_iso3 text DEFAULT NULL::text)
  RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_step_summary
LANGUAGE 'plpgsql'

COST 100
VOLATILE
ROWS 1000
AS $BODY$

declare
  form_ids text;

BEGIN

  form_ids := '{' || form_id || '}';

  CASE WHEN form_id is not null and c_iso3 is null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step_summary where formid=ANY(form_ids::int[]);
    WHEN form_id is null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step_summary where iso3=c_iso3;
    WHEN form_id is not null and c_iso3 is not null
    THEN return query select * from imet_assessment_v2.v_imet_eval_stat_step_summary where iso3=c_iso3 and formid=ANY(form_ids::int[]);
  ELSE
    return query select * from imet_assessment_v2.v_imet_eval_stat_step_summary;
  END CASE;
END;


$BODY$;






COMMIT;
