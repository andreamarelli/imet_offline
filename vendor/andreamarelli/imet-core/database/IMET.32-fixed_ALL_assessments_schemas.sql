BEGIN;

DROP SCHEMA IF EXISTS imet_assessment_v1_to_v2 CASCADE;
DROP SCHEMA IF EXISTS imet_assessment_v2 CASCADE;
DROP SCHEMA IF EXISTS imet_assessment CASCADE;

ALTER TABLE imet.imet_form ALTER COLUMN "Country" TYPE TEXT;

-- ###############################################
-- ###############################################
-- ###############################################

CREATE SCHEMA IF NOT EXISTS imet_assessment;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_c2(
	item_class text,
	tablename text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
wherec text;
  schemaname text;
sql text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
    wherec:= ' "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
else
    wherec:= '';
end if;

sql := 'select "FormID",'''||item_class||'''::text as section ,

		(SUM("EvaluationScore"*"EvaluationScore2")
		/
		SUM(
		CASE WHEN "EvaluationScore2">0 THEN "EvaluationScore2"
          WHEN "EvaluationScore2" is null then 0
            end ))*100/3::float as value_p

		from "'||schemaname||'"."'||tablename||'"

		where '||wherec||' "EvaluationScore" is not null and "EvaluationScore" !=''-99''::int and "EvaluationScore" > -4
		group by "FormID"
		order by "FormID"';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_c3(
	item_class text,
	tablename text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare

wherea text;
  schemaname text;
sql text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null
  then
    wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[])  ';
else
    wherea:= '';
end if;

sql := '

     with table0 as (select
"FormID" as formid,
"Impact"*(-1)+4 as impact,
"Extension"*(-1)+4 as extension,
"Duration"*(-1)+4 as duration,
"Probability"*(-1)+4 as probability,

((-0.75)*"Trend" + 2.5) as trend,
"group_key" as grpval

from "'||schemaname||'"."'||tablename||'"
 '||wherea||'
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

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_c12(
	item_class text,
	tablename text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
wherec text;
  schemaname text;
sql text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
    wherec:= ' "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
else
    wherec:= '';
end if;

sql := 'select "FormID",'''||item_class||'''::text as section ,
             (SUM( (1+2*"SignificativeClassification"::int)*"EvaluationScore") / SUM(1+2*"SignificativeClassification"::int))*100/3::float as value_p
             from "'||schemaname||'"."'||tablename||'"
	     where '||wherec||' "EvaluationScore" is not null and "EvaluationScore">=0 and "SignificativeClassification" is not null
	     group by "FormID"
	     order by "FormID"';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_c13(
	item_class text,
	tablename text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
wherec text;
  schemaname text;
sql text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
    wherec:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
else
    wherec:= '';
end if;

sql := '
        with table1 as (
           select "FormID","EvaluationScore",
             case when "SignificativeSpecies" is null then 0::int
                  when "SignificativeSpecies" is not null then "SignificativeSpecies"::int
             end as "SignificativeSpecies"
            from imet.eval_importance_c13
			'||wherec||'
        )
         select "FormID",'''||item_class||'''::text as section ,
             (SUM( (1+2*"SignificativeSpecies"::int)*"EvaluationScore") / SUM(1+2*"SignificativeSpecies"::int))*100/3::float as value_p
             from table1
	     where "EvaluationScore" is not null and "EvaluationScore">=0
	     group by "FormID"
	     order by "FormID"';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_c14(
	item_class text,
	tablename text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
wherec text;
  schemaname text;
sql text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
    wherec:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
else
    wherec:= '';
end if;

sql := '
     with table1 as (
           select "FormID","EvaluationScore",
             case when "EvaluationScore2" is null then 1::int
                  when "EvaluationScore2" is not null then "EvaluationScore2"::int
             end as "EvaluationScore2"
            from imet.eval_importance_c14
			'||wherec||'
        )

     select "FormID",'''||item_class||'''::text as section ,
             (SUM( ("EvaluationScore2"::int)*"EvaluationScore") / nullif(SUM("EvaluationScore2"::int),0))*100/3::float as value_p
             from table1
	     where "EvaluationScore" is not null and "EvaluationScore">=0
	     group by "FormID"
	     order by "FormID"';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_i2(
	item_class text,
	tablename text,
	field_value text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= ' where b."FormID" = ANY(''{'||form_id||'}''::int[]) ';
else
		wherea:= '';
end if;

  --temporary sql to put fixed value..TODO
sql := 'select "FormID",'''||item_class||'''::text as section , 88.1::double precision as value_p
     from "'||schemaname||'"."'||tablename||'"
     group by "FormID" order by "FormID";';

sql := '
     with table0 as (select
    a."FormID" as formid,
    a."Theme" as theme,
    a."EvaluationScore" as eval_sc,
    b."Function" as fun,
    b."ActualPermanent" as act_pr,
    b."ExpectedPermanent" as exp_pr,
    least(coalesce(sum(b."ActualPermanent"),0)/nullif(sum(b."ExpectedPermanent"),0),1) as ratio
from imet.context_management_staff b
right join "'||schemaname||'"."'||tablename||'" a on b."FormID" = a."FormID" and a."Theme"=b."Function"
'||wherea||'

group by a."FormID",a."EvaluationScore",a."Theme",b."Function",b."ExpectedPermanent",b."ActualPermanent"
), table1 as (
select
  formid,
  theme,
  act_pr,exp_pr,
  ratio,
  case when eval_sc is null then
        case when ratio = 0 then 0
             when ratio > 0 then ceil(ratio*4-1)
        end
   else eval_sc
  end as eval_sc,
  case when eval_sc is null then (1+ln(nullif(exp_pr,0)))
       else 1
  end as weight,
  case when eval_sc is null then
          case when ratio = 0 then 0
             when ratio > 0 then (1+ln(nullif(exp_pr,0)))*ceil(ratio*4-1)
        end
    else eval_sc * 1
    end as eval_sc_by_weight
from table0)

select
formid as "FormID", '''||item_class||'''::text as section ,
(sum(eval_sc_by_weight)/sum(weight)*100/3)::double precision as value_p
from table1 a
  group by formid order by formid
     ';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_i5(
	item_class text,
	tablename text,
	field_value text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= ' where a."FormID" = ANY(''{'||form_id||'}''::int[]) ';
else
		wherea:= '';
end if;

  --temporary sql to put fixed value..TODO
sql := 'select "FormID",'''||item_class||'''::text as section , 24.4::double precision as value_p
     from "'||schemaname||'"."'||tablename||'"
     group by "FormID" order by "FormID";';

sql := '
     with table0 as(
    select
    "FormID" as formid,
    "group_key" as group_res,
    avg("AdequacyLevel") as ad_level

    from imet.context_equipments a
	'||wherea||'

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
'||wherea||'
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

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_pr1(
	item_class text,
	tablename text,
	field_value text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
   schemaname text;
   sql text;
   wherea text;

BEGIN
  schemaname:= 'imet';

    if form_id is not null then
		wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
		wherea:= '';
    end if;

  --temporary sql to put fixed value..TODO
sql := 'select "FormID",'''||item_class||'''::text as section , 54.8::double precision as value_p
     from "'||schemaname||'"."'||tablename||'"
     group by "FormID" order by "FormID";';

sql := '
 with table0 as(
    select
    "FormID" as formid,
    "Theme" as theme,
    case when "EvaluationScore" is null then
              (select ratio03 from imet_assessment.imet_cm_i2_prep("FormID") where fun = "Theme")
         when "EvaluationScore" is not null then "EvaluationScore"
         else null
    end as eval_score,
    "PercentageLevel" as perc_lev,
    case when "EvaluationScore" is null then
               (select w_avg from imet_assessment.imet_cm_i2_prep("FormID") where fun = "Theme")
         when "EvaluationScore" is not null then 1
         else null
    end as weight
    from "'||schemaname||'"."'||tablename||'"
	'||wherea||'
)
select
formid as "FormID",'''||item_class||'''::text as section ,
round(sum(weight * eval_score)/sum(weight)*100/3::numeric,2)::double precision as value_p
from table0
group by "FormID" order by "FormID";
     ';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_cm_pr13(
	item_class text,
	tablename text,
	field_value text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
else
		wherea:= '';
end if;

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
'||wherea||'
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

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_group_all(
	item_class text,
	tablename text,
	field_value text,
	field_group_element text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text;

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
else
		wherea:= '';
end if;

sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,"'
         ||field_group_element||'"
     ,AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'"
     where '||wherea||' "EvaluationScore" != -99
     group by "'||field_group_element||'" , "FormID") as avg_t GROUP BY formid order by formid;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;


CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_rank_all(
	tablename text,
	field_value text,
	item_class text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text;


BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= ' a."FormID" = ANY(''{'||form_id||'}''::int[]) and ';
else
		wherea:= '';
end if;

sql:= 'select a."FormID",'''||item_class||'''::text as section,b."value_p" from '||schemaname||'."'||
        tablename||
        '" a JOIN "imet_assessment"."imet_rank_pval" b on a."'||
        field_value||
        '" = b."key" where '||wherea||' b.item_classification='''||
        item_class||'''
      group by a."FormID",b."value_p"
       order by a."FormID";';
raise notice 'sql %', sql;
RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_table_all(
	item_class text,
	tablename text,
	field_value text,
	form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
schemaname text;
sql text;
  wherea text DEFAULT '';

BEGIN
  schemaname:= 'imet';

  if form_id is not null then
		wherea:= '  "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
end if;

sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,'
                                         ' AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'" where '||wherea||' "'||field_value||'"!=(-99::numeric)
     group by "FormID") as avg_t GROUP BY formid order by formid;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_forms(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, "Year" integer, wdpa_id integer, iso3 text, name text)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  wherea text DEFAULT '';

BEGIN

	if form_id is not null then
		wherea:= ' where imet_form."FormID" = ANY(''{'||form_id||'}''::int[]) ';
    end if;

	if c_iso3 is not null then
		if form_id is not null then
			wherea:= wherea || ' and imet_form."Country" = '''||c_iso3||''' ';
        else
			wherea:= ' where imet_form."Country" =  '''||c_iso3||''' ';
        end if;
    end if;

    sql := ' SELECT imet_form."FormID" AS formid,
				imet_form."Year",
				imet_form.wdpa_id,
				imet_form."Country" as iso3,
				imet_form.name
			   FROM imet.imet_form
			   '||wherea||';';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step1(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, c1 numeric, c2 numeric, c3 numeric, c11 numeric, c12 numeric, c13 numeric, c14 numeric, c15 numeric, c16 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT ',NULL';
  form_parameters text DEFAULT 'NULL';
BEGIN

	if form_id is not null then
		parameters := ','''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||'''';
end if;


sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table_c2 AS (
         SELECT get_imet_evaluation_stats_cm_c2.formid,
            get_imet_evaluation_stats_cm_c2.section,
            get_imet_evaluation_stats_cm_c2.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c2(''C2''::text, ''eval_supports_and_constaints''::text '||parameters||')
        ), table_c3 AS (
         SELECT get_imet_evaluation_stats_cm_c3.formid,
            get_imet_evaluation_stats_cm_c3.section,
            get_imet_evaluation_stats_cm_c3.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c3(''C3''::text, ''context_menaces_pressions''::text '||parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.1''::text, ''eval_importance_c11''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_c12.formid,
            get_imet_evaluation_stats_cm_c12.section,
            get_imet_evaluation_stats_cm_c12.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c12(''C1.2''::text, ''eval_importance_c12''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_cm_c13.formid,
            get_imet_evaluation_stats_cm_c13.section,
            get_imet_evaluation_stats_cm_c13.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c13(''C1.3''::text, ''eval_importance_c13''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_cm_c14.formid,
            get_imet_evaluation_stats_cm_c14.section,
            get_imet_evaluation_stats_cm_c14.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c14(''C1.4''::text, ''eval_importance_c14''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.5''::text, ''eval_importance_c15''::text, ''EvaluationScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.6''::text, ''eval_importance_c16''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(((COALESCE(b.value_p, 0::double precision) + COALESCE(c.value_p, 0::double precision) + COALESCE(d.value_p, 0::double precision) + COALESCE(e.value_p, 0::double precision) + COALESCE(f.value_p, 0::double precision) + COALESCE(g.value_p, 0::double precision)) / NULLIF((( SELECT count(*) AS count
                   FROM ( VALUES (b.value_p), (c.value_p), (d.value_p), (e.value_p), (f.value_p), (g.value_p)) v(col)
                  WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 2) AS c1,
            round(c2.value_p::numeric, 2) AS c2,
            round(c3.value_p::numeric, 2) AS c3,
            round(b.value_p::numeric, 2) AS c11,
            round(c.value_p::numeric, 2) AS c12,
            round(d.value_p::numeric, 2) AS c13,
            round(e.value_p::numeric, 2) AS c14,
            round(f.value_p::numeric, 2) AS c15,
            round(g.value_p::numeric, 2) AS c16
           FROM table0 a
             LEFT JOIN table_c2 c2 ON a.formid = c2.formid
             LEFT JOIN table_c3 c3 ON a.formid = c3.formid
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
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
    tableall.c16,
    round(((COALESCE(tableall.c1, 0::numeric) + COALESCE(tableall.c2, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.c3, 0::numeric) + 100.0)::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (tableall.c1), (tableall.c2), (tableall.c3)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM tableall;';

RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step2(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, p1 numeric, p2 numeric, p3 numeric, p4 numeric, p5 numeric, p6 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
 parameters text DEFAULT ',NULL';
  form_parameters text DEFAULT 'NULL';
BEGIN

	if form_id is not null then
		parameters := ','''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||'''';
end if;


sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P1''::text, ''eval_regulations_adequacy''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P2''::text, ''eval_design_adequacy''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_boundary_level''::text, ''EvaluationScore''::text, ''EVAL P3''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P4''::text, ''eval_management_plan''::text, ''PlanExistenceScore''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P5''::text, ''eval_work_plan''::text, ''PlanExistenceScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P6''::text, ''eval_objectives''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS p1,
            round(c.value_p::numeric, 2) AS p2,
            round(d.value_p::numeric, 2) AS p3,
            round(e.value_p::numeric, 2) AS p4,
            round(f.value_p::numeric, 2) AS p5,
            round(g.value_p::numeric, 2) AS p6
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
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
    round(((COALESCE(tableall.p1, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.p2, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.p3, 0::numeric) + COALESCE(tableall.p4, 0::numeric) + COALESCE(tableall.p5, 0::numeric) + COALESCE(tableall.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (tableall.p1), (tableall.p2), (tableall.p3), (tableall.p4), (tableall.p5), (tableall.p6)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM tableall
  ORDER BY tableall.iso3, tableall.name;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step3(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, i1 numeric, i2 numeric, i3 numeric, i4 numeric, i5 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT ',NULL';
  form_parameters text DEFAULT 'NULL';
BEGIN

	if form_id is not null then
		parameters := ','''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
    end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''EVAL I1''::text, ''eval_information_availability''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_i2.formid,
            get_imet_evaluation_stats_cm_i2.section,
            get_imet_evaluation_stats_cm_i2.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_i2(''EVAL I2''::text, ''eval_staff''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_budget_adequacy''::text, ''EvaluationScore''::text, ''EVAL I3''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_budget_securization''::text, ''EvaluationScore''::text, ''EVAL I4''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_cm_i5.formid,
            get_imet_evaluation_stats_cm_i5.section,
            get_imet_evaluation_stats_cm_i5.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_i5(''EVAL I5''::text, ''eval_management_equipment_adequacy''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS i1,
            round(c.value_p::numeric, 2) AS i2,
            round(d.value_p::numeric, 2) AS i3,
            round(e.value_p::numeric, 2) AS i4,
            round(f.value_p::numeric, 2) AS i5
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
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
  ORDER BY tableall.iso3, tableall.name;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step4(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric, pr7 numeric, pr8 numeric, pr9 numeric, pr10 numeric, pr11 numeric, pr12 numeric, pr13 numeric, pr14 numeric, pr15 numeric, pr16 numeric, pr17 numeric, pr18 numeric, pr19 numeric, pr1_6 numeric, pr7_10 numeric, pr11_13 numeric, pr14_15 numeric, pr16_17 numeric, pr18_19 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT ',NULL';
  form_parameters text DEFAULT 'NULL';
BEGIN

	if form_id is not null then
		parameters := ','''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||'''';
end if;


sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_cm_pr1.formid,
            get_imet_evaluation_stats_cm_pr1.section,
            get_imet_evaluation_stats_cm_pr1.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr1(''PR1''::text, ''eval_staff_competence''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR2''::text, ''eval_hr_management_politics''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR3''::text, ''eval_hr_management_systems''::text, ''EvaluationScore''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR4''::text, ''eval_governance_leadership''::text, ''EvaluationScoreGovernace''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR5''::text, ''eval_administrative_management''::text, ''EvaluationScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR6''::text, ''eval_equipment_maintenance''::text, ''EvaluationScore''::text '||parameters||')
        ), table7 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR7''::text, ''eval_management_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table8 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR8''::text, ''eval_protection_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table9 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text '||parameters||')
        ), table10 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR10''::text, ''eval_law_enforcement''::text, ''EvaluationScore''::text '||parameters||')
        ), table11 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR11''::text, ''eval_implications''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table12 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR12''::text, ''eval_assistance_activities''::text, ''EvaluationScore''::text '||parameters||')
        ), table13 AS (
         SELECT get_imet_evaluation_stats_cm_pr13.formid,
            get_imet_evaluation_stats_cm_pr13.section,
            get_imet_evaluation_stats_cm_pr13.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr13(''PR13''::text, ''eval_actors_relations''::text, ''EvaluationScore''::text '||parameters||')
        ), table14 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR14''::text, ''eval_visitors_management''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table15 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR15''::text, ''eval_visitors_impact''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table16 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR16''::text, ''eval_natural_resources_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table17 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR17''::text, ''eval_research_and_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table18 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR18''::text, ''eval_climate_change_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table19 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR19''::text, ''eval_ecosystem_services''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS pr1,
            round(c.value_p::numeric, 2) AS pr2,
            round(d.value_p::numeric, 2) AS pr3,
            round(e.value_p::numeric, 2) AS pr4,
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
            round(s.value_p::numeric, 2) AS pr18,
            round(t.value_p::numeric, 2) AS pr19
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
             LEFT JOIN table19 t ON a.formid = t.formid
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
    tableall.pr19,
    round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS pr1_6,
    round(((COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric) + COALESCE(tableall.pr10, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr7), (tableall.pr8), (tableall.pr9), (tableall.pr10)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr7_10,
    round(((COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric) + COALESCE(tableall.pr13, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr11), (tableall.pr12), (tableall.pr13)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr11_13,
    round(((COALESCE(tableall.pr14, 0::numeric) + COALESCE(tableall.pr15, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr14), (tableall.pr15)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr14_15,
    round(((COALESCE(tableall.pr16, 0::numeric) + COALESCE(tableall.pr17, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr16), (tableall.pr17)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr16_17,
    round(((COALESCE(tableall.pr18, 0::numeric) + COALESCE(tableall.pr19, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr18), (tableall.pr19)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr18_19,
    round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric) + COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric) + COALESCE(tableall.pr10, 0::numeric) + COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric) + COALESCE(tableall.pr13, 0::numeric) + COALESCE(tableall.pr14, 0::numeric) + COALESCE(tableall.pr15, 0::numeric) + COALESCE(tableall.pr16, 0::numeric) + COALESCE(tableall.pr17, 0::numeric) + COALESCE(tableall.pr18, 0::numeric) + COALESCE(tableall.pr19, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6), (tableall.pr7), (tableall.pr8), (tableall.pr9), (tableall.pr10), (tableall.pr11), (tableall.pr12), (tableall.pr13), (tableall.pr14), (tableall.pr15), (tableall.pr16), (tableall.pr17), (tableall.pr18), (tableall.pr19)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM tableall;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step5(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, r1 numeric, r2 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT ',NULL';
  form_parameters text DEFAULT 'NULL';
BEGIN

	if form_id is not null then
		parameters := ','''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||'''';
end if;


sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''R1''::text, ''eval_work_program_implementation''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''R2''::text, ''eval_achieved_results''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS r1,
            round(c.value_p::numeric, 2) AS r2
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.r1,
    tableall.r2,
    round(((COALESCE(tableall.r1, 0::numeric) + COALESCE(tableall.r2, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.r1), (tableall.r2)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
   FROM tableall;' ;

RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_evaluation_stats_by_formid_step6(
	form_id text DEFAULT NULL::text,
	c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, ei1 numeric, ei2 numeric, ei3 numeric, ei4 numeric, ei5 numeric, ei6 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
sql text;
  parameters text DEFAULT ', NULL';
  form_parameters text DEFAULT 'NULL';

BEGIN

	if form_id is not null then
		parameters := ', '''||form_id||''' ';
		form_parameters := ''''||form_id||'''';
end if;

	if c_iso3 is not null then
		form_parameters := form_parameters || ', '''||c_iso3||''' ';
else
		form_parameters := form_parameters || ', NULL';
end if;

sql := ' WITH table0 AS (
         SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I1''::text, ''eval_achived_objectives''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''E/I2''::text, ''eval_designated_values_conservation''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''E/I3''::text, ''eval_designated_values_conservation_tendency''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I4''::text, ''eval_local_communities_impact''::text, ''EvaluationScore''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I5''::text, ''eval_climate_change_impact''::text, ''EvaluationScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I6''::text, ''eval_ecosystem_services_impact''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(b.value_p::numeric, 2) AS ei1,
            round(c.value_p::numeric, 2) AS ei2,
            round(d.value_p::numeric, 2) AS ei3,
            round(e.value_p::numeric, 2) AS ei4,
            round(f.value_p::numeric, 2) AS ei5,
            round(g.value_p::numeric, 2) AS ei6
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.ei1,
    tableall.ei2,
    tableall.ei3,
    tableall.ei4,
    tableall.ei5,
    tableall.ei6,
    round(((COALESCE(tableall.ei1, 0::numeric)::double precision + COALESCE(tableall.ei2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei3::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei4::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei5::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei6::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.ei1), (tableall.ei2), (tableall.ei3), (tableall.ei4), (tableall.ei5), (tableall.ei6)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM tableall;';

RETURN QUERY EXECUTE sql;
END;
$BODY$;


CREATE VIEW imet_assessment.v_imet_forms AS
SELECT DISTINCT "FormID",
                "Year",
                wdpa_id,
                "Country" AS iso3,
                name
FROM imet.imet_form
ORDER BY "FormID", "Year";

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step1 AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table_c2 AS (
    SELECT get_imet_evaluation_stats_cm_c2.formid,
           get_imet_evaluation_stats_cm_c2.section,
           get_imet_evaluation_stats_cm_c2.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_c2('C2'::text, 'eval_supports_and_constaints'::text, NULL::text)
), table_c3 AS (
    SELECT get_imet_evaluation_stats_cm_c3.formid,
           get_imet_evaluation_stats_cm_c3.section,
           get_imet_evaluation_stats_cm_c3.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_c3('C3'::text, 'context_menaces_pressions'::text, NULL::text)
), table1 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('C1.1'::text, 'eval_importance_c11'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_cm_c12.formid,
           get_imet_evaluation_stats_cm_c12.section,
           get_imet_evaluation_stats_cm_c12.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_c12('C1.2'::text, 'eval_importance_c12'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_cm_c13.formid,
           get_imet_evaluation_stats_cm_c13.section,
           get_imet_evaluation_stats_cm_c13.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_c13('C1.3'::text, 'eval_importance_c13'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_cm_c14.formid,
           get_imet_evaluation_stats_cm_c14.section,
           get_imet_evaluation_stats_cm_c14.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_c14('C1.4'::text, 'eval_importance_c14'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('C1.5'::text, 'eval_importance_c15'::text, 'EvaluationScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('C1.6'::text, 'eval_importance_c16'::text, 'EvaluationScore'::text, NULL::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(((COALESCE(b.value_p, 0::double precision) + COALESCE(c.value_p, 0::double precision) + COALESCE(d.value_p, 0::double precision) + COALESCE(e.value_p, 0::double precision) + COALESCE(f.value_p, 0::double precision) + COALESCE(g.value_p, 0::double precision)) / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                FROM ( VALUES (b.value_p), (c.value_p), (d.value_p), (e.value_p), (f.value_p), (g.value_p)) v(col)
                                                                                                                                                                                                                                                                                                WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 2) AS c1,
           round(c2.value_p::numeric, 2) AS c2,
           round(c3.value_p::numeric, 2) AS c3,
           round(b.value_p::numeric, 2) AS c11,
           round(c.value_p::numeric, 2) AS c12,
           round(d.value_p::numeric, 2) AS c13,
           round(e.value_p::numeric, 2) AS c14,
           round(f.value_p::numeric, 2) AS c15,
           round(g.value_p::numeric, 2) AS c16
    FROM table0 a
             LEFT JOIN table_c2 c2 ON a.formid = c2.formid
             LEFT JOIN table_c3 c3 ON a.formid = c3.formid
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
                tableall.c1,
                tableall.c2,
                tableall.c3,
                tableall.c11,
                tableall.c12,
                tableall.c13,
                tableall.c14,
                tableall.c15,
                tableall.c16,
                round(((COALESCE(tableall.c1, 0::numeric) + COALESCE(tableall.c2, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.c3, 0::numeric) + 100.0)::double precision / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                      FROM ( VALUES (tableall.c1), (tableall.c2), (tableall.c3)) v(col)
                                                                                                                                                                                      WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
FROM tableall
ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step2
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('P1'::text, 'eval_regulations_adequacy'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('P2'::text, 'eval_design_adequacy'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_rank_all('eval_boundary_level'::text, 'EvaluationScore'::text, 'EVAL P3'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('P4'::text, 'eval_management_plan'::text, 'PlanExistenceScore'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('P5'::text, 'eval_work_plan'::text, 'PlanExistenceScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('P6'::text, 'eval_objectives'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(b.value_p::numeric, 2) AS p1,
           round(c.value_p::numeric, 2) AS p2,
           round(d.value_p::numeric, 2) AS p3,
           round(e.value_p::numeric, 2) AS p4,
           round(f.value_p::numeric, 2) AS p5,
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
                round(((COALESCE(tableall.p1, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.p2, 0::numeric) / 2.0 + 50.0 + COALESCE(tableall.p3, 0::numeric) + COALESCE(tableall.p4, 0::numeric) + COALESCE(tableall.p5, 0::numeric) + COALESCE(tableall.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                       FROM ( VALUES (tableall.p1), (tableall.p2), (tableall.p3), (tableall.p4), (tableall.p5), (tableall.p6)) v(col)
                                                                                                                                                                                                                                                                                                       WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
FROM tableall
ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step3
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('EVAL I1'::text, 'eval_information_availability'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_cm_i2.formid,
           get_imet_evaluation_stats_cm_i2.section,
           get_imet_evaluation_stats_cm_i2.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_i2('EVAL I2'::text, 'eval_staff'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_rank_all('eval_budget_adequacy'::text, 'EvaluationScore'::text, 'EVAL I3'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_rank_all('eval_budget_securization'::text, 'EvaluationScore'::text, 'EVAL I4'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_cm_i5.formid,
           get_imet_evaluation_stats_cm_i5.section,
           get_imet_evaluation_stats_cm_i5.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_i5('EVAL I5'::text, 'eval_management_equipment_adequacy'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(b.value_p::numeric, 2) AS i1,
           round(c.value_p::numeric, 2) AS i2,
           round(d.value_p::numeric, 2) AS i3,
           round(e.value_p::numeric, 2) AS i4,
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

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step4
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_cm_pr1.formid,
           get_imet_evaluation_stats_cm_pr1.section,
           get_imet_evaluation_stats_cm_pr1.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_pr1('PR1'::text, 'eval_staff_competence'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR2'::text, 'eval_hr_management_politics'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR3'::text, 'eval_hr_management_systems'::text, 'EvaluationScore'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR4'::text, 'eval_governance_leadership'::text, 'EvaluationScoreGovernace'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR5'::text, 'eval_administrative_management'::text, 'EvaluationScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR6'::text, 'eval_equipment_maintenance'::text, 'EvaluationScore'::text, NULL::text)
), table7 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR7'::text, 'eval_management_activities'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table8 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR8'::text, 'eval_protection_activities'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table9 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_rank_all('eval_control'::text, 'EvaluationScore'::text, 'EVAL PR9'::text, NULL::text)
), table10 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR10'::text, 'eval_law_enforcement'::text, 'EvaluationScore'::text, NULL::text)
), table11 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR11'::text, 'eval_implications'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table12 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR12'::text, 'eval_assistance_activities'::text, 'EvaluationScore'::text, NULL::text)
), table13 AS (
    SELECT get_imet_evaluation_stats_cm_pr13.formid,
           get_imet_evaluation_stats_cm_pr13.section,
           get_imet_evaluation_stats_cm_pr13.value_p
    FROM imet_assessment.get_imet_evaluation_stats_cm_pr13('PR13'::text, 'eval_actors_relations'::text, 'EvaluationScore'::text, NULL::text)
), table14 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR14'::text, 'eval_visitors_management'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table15 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR15'::text, 'eval_visitors_impact'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table16 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR16'::text, 'eval_natural_resources_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), table17 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR17'::text, 'eval_research_and_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), table18 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('PR18'::text, 'eval_climate_change_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), table19 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('PR19'::text, 'eval_ecosystem_services'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(b.value_p::numeric, 2) AS pr1,
           round(c.value_p::numeric, 2) AS pr2,
           round(d.value_p::numeric, 2) AS pr3,
           round(e.value_p::numeric, 2) AS pr4,
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
           round(s.value_p::numeric, 2) AS pr18,
           round(t.value_p::numeric, 2) AS pr19
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
             LEFT JOIN table19 t ON a.formid = t.formid
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
                tableall.pr19,
                round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                  FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6)) v(col)
                                                                                                                                                                                                                                                                                  WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS pr1_6,
                round(((COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric) + COALESCE(tableall.pr10, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                         FROM ( VALUES (tableall.pr7), (tableall.pr8), (tableall.pr9), (tableall.pr10)) v(col)
                                                                                                                                                                                                         WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr7_10,
                round(((COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric) + COALESCE(tableall.pr13, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                      FROM ( VALUES (tableall.pr11), (tableall.pr12), (tableall.pr13)) v(col)
                                                                                                                                                                      WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr11_13,
                round(((COALESCE(tableall.pr14, 0::numeric) + COALESCE(tableall.pr15, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                FROM ( VALUES (tableall.pr14), (tableall.pr15)) v(col)
                                                                                                                                WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr14_15,
                round(((COALESCE(tableall.pr16, 0::numeric) + COALESCE(tableall.pr17, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                FROM ( VALUES (tableall.pr16), (tableall.pr17)) v(col)
                                                                                                                                WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr16_17,
                round(((COALESCE(tableall.pr18, 0::numeric) + COALESCE(tableall.pr19, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                FROM ( VALUES (tableall.pr18), (tableall.pr19)) v(col)
                                                                                                                                WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS pr18_19,
                round(((COALESCE(tableall.pr1, 0::numeric) + COALESCE(tableall.pr2, 0::numeric) + COALESCE(tableall.pr3, 0::numeric) + COALESCE(tableall.pr4, 0::numeric) + COALESCE(tableall.pr5, 0::numeric) + COALESCE(tableall.pr6, 0::numeric) + COALESCE(tableall.pr7, 0::numeric) + COALESCE(tableall.pr8, 0::numeric) + COALESCE(tableall.pr9, 0::numeric) + COALESCE(tableall.pr10, 0::numeric) + COALESCE(tableall.pr11, 0::numeric) + COALESCE(tableall.pr12, 0::numeric) + COALESCE(tableall.pr13, 0::numeric) + COALESCE(tableall.pr14, 0::numeric) + COALESCE(tableall.pr15, 0::numeric) + COALESCE(tableall.pr16, 0::numeric) + COALESCE(tableall.pr17, 0::numeric) + COALESCE(tableall.pr18, 0::numeric) + COALESCE(tableall.pr19, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             FROM ( VALUES (tableall.pr1), (tableall.pr2), (tableall.pr3), (tableall.pr4), (tableall.pr5), (tableall.pr6), (tableall.pr7), (tableall.pr8), (tableall.pr9), (tableall.pr10), (tableall.pr11), (tableall.pr12), (tableall.pr13), (tableall.pr14), (tableall.pr15), (tableall.pr16), (tableall.pr17), (tableall.pr18), (tableall.pr19)) v(col)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
FROM tableall;

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step5 AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('R1'::text, 'eval_work_program_implementation'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('R2'::text, 'eval_achieved_results'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(b.value_p::numeric, 2) AS r1,
           round(c.value_p::numeric, 2) AS r2
    FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.wdpa_id,
                tableall.iso3,
                tableall.name,
                tableall.r1,
                tableall.r2,
                round(((COALESCE(tableall.r1, 0::numeric) + COALESCE(tableall.r2, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                            FROM ( VALUES (tableall.r1), (tableall.r2)) v(col)
                                                                                                                            WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
FROM tableall;

CREATE OR REPLACE VIEW imet_assessment.v_imet_eval_stat_step6 AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year",
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('E/I1'::text, 'eval_achived_objectives'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('E/I2'::text, 'eval_designated_values_conservation'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_group_all('E/I3'::text, 'eval_designated_values_conservation_tendency'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('E/I4'::text, 'eval_local_communities_impact'::text, 'EvaluationScore'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('E/I5'::text, 'eval_climate_change_impact'::text, 'EvaluationScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_table_all('E/I6'::text, 'eval_ecosystem_services_impact'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(b.value_p::numeric, 2) AS ei1,
           round(c.value_p::numeric, 2) AS ei2,
           round(d.value_p::numeric, 2) AS ei3,
           round(e.value_p::numeric, 2) AS ei4,
           round(f.value_p::numeric, 2) AS ei5,
           round(g.value_p::numeric, 2) AS ei6
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
                tableall.ei1,
                tableall.ei2,
                tableall.ei3,
                tableall.ei4,
                tableall.ei5,
                tableall.ei6,
                round(((COALESCE(tableall.ei1, 0::numeric)::double precision + COALESCE(tableall.ei2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei3::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei4::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei5::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(tableall.ei6::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          FROM ( VALUES (tableall.ei1), (tableall.ei2), (tableall.ei3), (tableall.ei4), (tableall.ei5), (tableall.ei6)) v(col)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
FROM tableall;

CREATE VIEW imet_assessment.v_imet_eval_stat_step_summary AS
WITH table0 AS (
    SELECT imet_assessment.v_imet_forms."FormID" AS formid,
           imet_assessment.v_imet_forms."Year" as year,
           imet_assessment.v_imet_forms.wdpa_id,
           imet_assessment.v_imet_forms.iso3,
           imet_assessment.v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT imet_assessment.v_imet_eval_stat_step1.formid,
           imet_assessment.v_imet_eval_stat_step1.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step1
), table2 AS (
    SELECT imet_assessment.v_imet_eval_stat_step2.formid,
           imet_assessment.v_imet_eval_stat_step2.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step2
), table3 AS (
    SELECT imet_assessment.v_imet_eval_stat_step3.formid,
           imet_assessment.v_imet_eval_stat_step3.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step3
), table4 AS (
    SELECT imet_assessment.v_imet_eval_stat_step4.formid,
           imet_assessment.v_imet_eval_stat_step4.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step4
), table5 AS (
    SELECT imet_assessment.v_imet_eval_stat_step5.formid,
           imet_assessment.v_imet_eval_stat_step5.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step5
), table6 AS (
    SELECT imet_assessment.v_imet_eval_stat_step6.formid,
           imet_assessment.v_imet_eval_stat_step6.avg_indicator
    FROM imet_assessment.v_imet_eval_stat_step6
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.year,
           a.iso3,
           a.name,
           b.avg_indicator AS context,
           c.avg_indicator AS plans,
           d.avg_indicator AS inputs,
           e.avg_indicator AS process,
           f.avg_indicator AS outputs,
           g.avg_indicator AS outcomes
    FROM ((((((table0 a
        LEFT JOIN table1 b ON ((a.formid = b.formid)))
        LEFT JOIN table2 c ON ((a.formid = c.formid)))
        LEFT JOIN table3 d ON ((a.formid = d.formid)))
        LEFT JOIN table4 e ON ((a.formid = e.formid)))
        LEFT JOIN table5 f ON ((a.formid = f.formid)))
             LEFT JOIN table6 g ON ((a.formid = g.formid)))
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.wdpa_id,
                tableall.year,
                tableall.iso3,
                tableall.name,
                tableall.context,
                tableall.plans,
                tableall.inputs,
                tableall.process,
                tableall.outputs,
                tableall.outcomes
FROM tableall;







CREATE FUNCTION imet_assessment.get_imet_evaluation_stats_step_summary(form_id text DEFAULT NULL::text, c_iso3 text DEFAULT NULL::text) RETURNS SETOF imet_assessment.v_imet_eval_stat_step_summary
    LANGUAGE plpgsql
AS $$

declare
    form_ids text;

BEGIN

    form_ids := '{' || form_id || '}';

    CASE WHEN form_id is not null and c_iso3 is null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where formid=ANY(form_ids::int[]);
         WHEN form_id is null and c_iso3 is not null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where iso3=c_iso3;
         WHEN form_id is not null and c_iso3 is not null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where iso3=c_iso3 and formid=ANY(form_ids::int[]);
         ELSE
             return query select * from imet_assessment.v_imet_eval_stat_step_summary;
        END CASE;
END;

$$;

CREATE FUNCTION imet_assessment.get_imet_evaluation_stats_step_summary_bkp(form_id integer DEFAULT NULL::integer, c_iso3 text DEFAULT NULL::text) RETURNS SETOF imet_assessment.v_imet_eval_stat_step_summary
    LANGUAGE plpgsql
AS $$

BEGIN

    CASE WHEN form_id is not null and c_iso3 is null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where formid=form_id;
         WHEN form_id is null and c_iso3 is not null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where iso3=c_iso3;
         WHEN form_id is not null and c_iso3 is not null
             THEN return query select * from imet_assessment.v_imet_eval_stat_step_summary where iso3=c_iso3 and formid=form_id;
         ELSE
             return query select * from imet_assessment.v_imet_eval_stat_step_summary;
        END CASE;
END;

$$;



CREATE FUNCTION imet_assessment.get_imet_metadata() RETURNS SETOF imet.imet_metadata
    LANGUAGE plpgsql
AS $$

BEGIN
    return query select * from imet.imet_metadata where version = 'v1';
END;


$$;

CREATE OR REPLACE FUNCTION imet_assessment.get_imet_stat_labels()
    RETURNS TABLE(code text, code_label text, title_fr text, title_en text, title_sp text) AS
$BODY$

declare
    sql text;

BEGIN

    sql:= 'SELECT code::text, code_label::text,title_fr::text,title_en::text,title_sp::text from imet.imet_metadata_statistics WHERE version=''v1'';';

    RETURN QUERY EXECUTE sql;
END;

$BODY$
    LANGUAGE plpgsql VOLATILE
                     COST 100
                     ROWS 1000;

CREATE TABLE imet_assessment.imet_tables_raw (
                                                 tid integer,
                                                 phase text,
                                                 itclass text,
                                                 tn text,
                                                 tjson text
);

CREATE FUNCTION imet_assessment.get_imet_tables_data(tableid integer, qfields text DEFAULT NULL::text, where_c text DEFAULT NULL::text) RETURNS SETOF imet_assessment.imet_tables_raw
    LANGUAGE plpgsql
AS $$

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
        FROM imet.imet_metadata WHERE version = 'v1' AND id=tableid
    );

    tid:= (
        SELECT id
        FROM imet.imet_metadata WHERE version = 'v1' AND id=tableid
    );

    phase:= (
        SELECT imet.imet_metadata.phase
        FROM imet.imet_metadata WHERE version = 'v1' AND id=tableid
    );

    itclass:= (
        SELECT code
        FROM imet.imet_metadata WHERE version = 'v1' AND id=tableid
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

$$;

CREATE FUNCTION imet_assessment.imet_cm_i2_prep(form_id integer DEFAULT NULL::integer) RETURNS TABLE(formid integer, fun text, ratio03 numeric, w_avg numeric)
    LANGUAGE plpgsql
AS $$

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

$$;




CREATE TABLE imet_assessment.imet_rank_pval (
                                                id integer NOT NULL,
                                                key integer,
                                                value_p double precision,
                                                item_classification text
);



CREATE SEQUENCE imet_assessment.imet_rank_pval_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE imet_assessment.imet_rank_pval_id_seq OWNED BY imet_assessment.imet_rank_pval.id;

ALTER TABLE ONLY imet_assessment.imet_rank_pval ALTER COLUMN id SET DEFAULT nextval('imet_assessment.imet_rank_pval_id_seq'::regclass);

ALTER TABLE ONLY imet_assessment.imet_rank_pval
    ADD CONSTRAINT imet_rank_pval_pkey PRIMARY KEY (id);
INSERT INTO imet_assessment.imet_rank_pval VALUES (1, 1, 17.5, 'EVAL I3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (2, 2, 53, 'EVAL I3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (3, 4, 100, 'EVAL I3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (4, 3, 85.5, 'EVAL I3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (7, 4, 100, 'EVAL I4');
INSERT INTO imet_assessment.imet_rank_pval VALUES (8, 3, 83.2999999999999972, 'EVAL I4');
INSERT INTO imet_assessment.imet_rank_pval VALUES (9, 2, 50, 'EVAL I4');
INSERT INTO imet_assessment.imet_rank_pval VALUES (10, 1, 16.6999999999999993, 'EVAL I4');
INSERT INTO imet_assessment.imet_rank_pval VALUES (11, 2, 62.5, 'EVAL P3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (12, 1, 25, 'EVAL P3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (13, 4, 100, 'EVAL P3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (14, 3, 87.5, 'EVAL P3');
INSERT INTO imet_assessment.imet_rank_pval VALUES (16, 0, 12.5, 'EVAL PR9');
INSERT INTO imet_assessment.imet_rank_pval VALUES (15, 1, 37.5, 'EVAL PR9');
INSERT INTO imet_assessment.imet_rank_pval VALUES (18, 2, 62.5, 'EVAL PR9');
INSERT INTO imet_assessment.imet_rank_pval VALUES (17, 3, 87.5, 'EVAL PR9');
INSERT INTO imet_assessment.imet_rank_pval VALUES (19, 4, 100, 'EVAL PR9');



-- ###############################################
-- ###############################################
-- ###############################################

CREATE SCHEMA IF NOT EXISTS imet_assessment_v2;

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
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
declare
    wherec text;
    sql text;

BEGIN

    if form_id is not null
    then
        wherec:= 'where "FormID" = '||form_id;
    else
        wherec:= '';
    end if;

    sql:= '
with tableratio as (
select "FormID" as formid,"Function" as fun,
"ExpectedPermanent" as exp_per,
"ActualPermanent" as act_per,
least(coalesce("ActualPermanent",0)/nullif("ExpectedPermanent",0),1) as ratio

from imet.context_management_staff ' || wherec ||')
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
from tableratio03weight c ;';
--raise notice 'query: %', sql;
    RETURN QUERY EXECUTE sql;

END;
$$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_table_all(
    item_class text,
    tablename text,
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';
    raise notice 'formid : %', form_id;
    if form_id is not null then
        wherea:= '  "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
    else
        wherea:= '';
    end if;

    sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,'
        ' AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'" where '||wherea||' "'||field_value||'"!=(-99::numeric)
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
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
    else
        wherea:= '';
    end if;

    sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/4*100::float as value_p
	 from
	 (select "FormID" as formid,'
        ' AVG("'||field_value||'")as avg_g
	 from "'||schemaname||'"."'||tablename||'" where '||wherea||' "'||field_value||'"!=(-99::numeric)
	 group by "FormID") as avg_t GROUP BY formid order by formid;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_rank_all(
    tablename text,
    field_value text,
    item_class text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' and a."FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    sql:= 'select a."FormID",'''||item_class||'''::text as section,b."value_p" from '||schemaname||'."'||
          tablename||
          '" a JOIN "imet_assessment_v2"."imet_rank_pval" b on a."'||
          field_value||
          '" = b."key" where b.item_classification='''||
          item_class||'''
		'||wherea||'
      group by a."FormID",b."value_p"
       order by a."FormID";';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_group_all(
    item_class text,
    tablename text,
    field_value text,
    field_group_element text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' and "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
		 from
		 (select "FormID" as formid,"'
               ||field_group_element||'"
		 ,AVG("'||field_value||'")as avg_g
		 from "'||schemaname||'"."'||tablename||'"
		 where "EvaluationScore" != -99 '||wherea||'
		 group by "'||field_group_element||'" , "FormID") as avg_t GROUP BY formid order by formid;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_group_all_fix(
    item_class text,
    tablename text,
    field_value text,
    field_group_element text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
    else
        wherea:= '';
    end if;

    sql := 'select formid,'''||item_class||'''::text as section ,AVG(avg_t.avg_g)/3*100::float as value_p
     from
     (select "FormID" as formid,"'
               ||field_group_element||'"
     ,AVG("'||field_value||'")as avg_g
     from "'||schemaname||'"."'||tablename||'"
     where '||wherea||' "'||field_value||'" != -99
     group by "'||field_group_element||'" , "FormID") as avg_t GROUP BY formid order by formid;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c2(
    item_class text,
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    wherec text DEFAULT '';
    schemaname text;
    sql text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null
    then
        wherec:= ' "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
    end if;


    sql := 'select "FormID",'''||item_class||'''::text as section ,

                (SUM("EvaluationScore"*"EvaluationScore2")
                /
                SUM( "EvaluationScore" ))*100/3::float as value_p
                from "'||schemaname||'"."'||tablename||'"
	            where '||wherec||' "EvaluationScore" is not null
                and "EvaluationScore" > -4
                and "EvaluationScore2" is not null and "EvaluationScore2">-4
				group by "FormID"
                order by "FormID"';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_c3(
    item_class text,
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    wherec text DEFAULT '';
    wherea text DEFAULT '';
    schemaname text;
    sql text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null
    then
        wherec:= ' "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
        wherea:= ' where a."FormID" = ANY(''{'||form_id||'}''::int[])  ';
    end if;

    sql := '
with table_include as (
  select "FormID",
			"Aspect",
			"IncludeInStatistics"
			from imet.eval_menaces
			where '||wherec||' "IncludeInStatistics"::int = 1
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
'||wherea||'
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
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';
    raise notice 'formid: %', form_id;
    if form_id is not null
    then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[])  ';
    else
        wherea:= '';
    end if;

    sql := '
  with tab0 as (
        select
        "FormID",
        case when "SignificativeClassification" is null then 0::int
        else "SignificativeClassification"::int
        end  as sign_c,
        "EvaluationScore" as score
        from "'||schemaname||'"."'||tablename||'"
		'||wherea||'
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
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null
    then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[])  ';
    else
        wherea:= '';
    end if;

    sql := '
        with table1 as (
           select "FormID","EvaluationScore",
             case when "SignificativeSpecies" is null then 0::int
                  when "SignificativeSpecies" is not null then "SignificativeSpecies"::int
             end as "SignificativeSpecies",
			"IncludeInStatistics"::int as include
            from imet.eval_importance_c13
			'||wherea||'
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
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[])  ';
    else
        wherea:= '';
    end if;

    sql := '
     with table1 as (
           select "FormID","EvaluationScore",
             case when "EvaluationScore2" is null then 1::int
                  when "EvaluationScore2" is not null then "EvaluationScore2"::int
             end as "EvaluationScore2",
	        "IncludeInStatistics"::int as include
            from imet.eval_importance_c14
			'||wherea||'
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
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;
    whereb text;

BEGIN
    schemaname:= 'imet';
    raise notice 'formid: %', form_id;
    if form_id is not null then
        whereb:= ' where "FormID" = ANY(''{'||form_id||'}''::int[])  ';
        wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[])  and ';
    else
        whereb:= '';
        wherea:= '';
    end if;

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
	where '||wherea||' "IncludeInStatistics"::int = 1
), table_w as (
  select "FormID",
	"Element",
	(coalesce("Importance",0.) + coalesce("ImportanceRegional"/3.,0.) + coalesce((2 - "ImportanceGlobal")/4.,0.))
	/ 3.0
	as weight
	from imet.context_ecosystem_services
	'||whereb||'
)
select a."FormID",'''||item_class||'''::text as section,
 sum(coalesce(b.weight,0.) * coalesce(a.score/3.0,0.))/sum(coalesce(b.weight,0.))
 *100.0::double precision as value_p
from table1 a
join table_w b on b."FormID" = a."FormID" and a."Aspect" = b."Element"
 where score is not null
 group by a."FormID"
 order by a."FormID" ';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_i2(
    item_class text,
    tablename text,
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    sql := '
		with table0 as(
		   select "FormID" as formid,
			"Function",
			nullif(sum("ActualPermanent"),0)/nullif(sum("ExpectedPermanent"),0) as ratio
			from imet.context_management_staff
			'||wherea||'
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
		  group by formid order by formid';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_i5(
    item_class text,
    tablename text,
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;
    whereb text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where a."FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    sql := '
		 with table0 as(
		select
		"FormID" as formid,
		"group_key" as group_res,
		avg("AdequacyLevel") as ad_level

		from imet.context_equipments a
		'||wherea||'
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
	'||wherea||'
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
    field_value2 text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
    else
        wherea:= '';
    end if;

    sql := '
with table_pre as (
	select "FormID",
	"Condition",
	"Trend",
	group_key
	from imet."eval_key_conservation_trends"
	where '||wherea||' "Condition"<>-99 and "Trend"<>-99
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
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text;

BEGIN

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;
    sql := '

				with table0 as (select

				"FormID" as formid,
                                "Patrol" as patrol,
                                "RapidIntervention" as rapid,
                                "AirVehicles"::integer as airv,
                                "Planes"::integer as planes
                                 from imet."'||tablename||'"
								 '||wherea||'
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
				from table0;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_p3(
    item_class text,
    tablename text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;
    whereb text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
        whereb:=  ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
    else
        wherea:= '';
        whereb:= '';
    end if;

    sql := 'with table0 as (
		select "FormID" as formid, "Boundaries" as degree,
		case when "EvaluationScore" is null or "EvaluationScore"=-99 then 0.
		else "EvaluationScore"
		end
		as score
		from imet.eval_boundary_level_v2
		'||wherea||'
		)
		, table1 as (
		   select "FormID" as formid, count("EvaluationScore") not_null from imet.eval_boundary_level_v2
			where '||whereb||' "EvaluationScore" is not null
			group by "FormID"
		)
		select a.formid, '''||item_class||'''::text as section,
            case when b.not_null is null then
                (coalesce(avg(a.degree/6.0)*100,0))::double precision
            else
                (coalesce(avg(a.degree/6.0)*100/2.0,0) + sum(coalesce((a.score/3.0)*100,0)/2.0)/b.not_null)::double precision
            end
                as value_p
		 from table0 a
		 left join table1 b on a.formid=b.formid
		group by a.formid,b.not_null
	  ';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr1(
    item_class text,
    tablename text,
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;


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
			'||wherea||'
		)
		select
		formid as "FormID",'''||item_class||'''::text as section ,
		round( 100.0/6.0 * ((sum(weight * eval_score) + sum(weight * perc_lev))/sum(weight) )::numeric ,2 )::double precision as value_p
		from table0
		group by "FormID" order by "FormID";
     ';

--raise notice 'query : %', sql;

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr6(
    item_class text,
    tablename text,
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

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

from imet.eval_equipment_maintenance
'||wherea||')

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
    field_group_element text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' "FormID" = ANY(''{'||form_id||'}''::int[]) and ';
    else
        wherea:= '';
    end if;

    sql := 'with table_include as (
   select * from imet."eval_management_activities"
	where '||wherea||' "InManagementPlan"::int = 1
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
    field_group_element text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

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
	'||wherea||'
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
    field_value text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text;

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    --temporary sql to put fixed value..TODO
    sql := 'select "FormID",'''||item_class||'''::text as section , 43.3::double precision as value_p
     from "'||schemaname||'"."'||tablename||'"
	 '||wherea||'
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
	'||wherea||'
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
    field_group_element2 text,
    form_id text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, section text, value_p double precision)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    schemaname text;
    sql text;
    wherea text DEFAULT '';

BEGIN
    schemaname:= 'imet';

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    end if;

    sql := '
	with table0 as(
		select "FormID" as formid,
		nullif("EvaluationScore",-99) as score,
		group_key
		from imet.eval_ecosystem_services
		'||wherea||'
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

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr1_pr6
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table1 AS (
    SELECT get_imet_evaluation_stats_cm_pr1.formid,
           get_imet_evaluation_stats_cm_pr1.section,
           get_imet_evaluation_stats_cm_pr1.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr1('PR1'::text, 'eval_staff_competence'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR2'::text, 'eval_hr_management_politics'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR3'::text, 'eval_hr_management_systems'::text, 'EvaluationScore'::text, NULL::text)
), table4 AS (
    SELECT eval_governance_leadership."FormID" AS formid,
           'PR4' AS section,
           (eval_governance_leadership."EvaluationScoreGovernace" + eval_governance_leadership."EvaluationScoreLeadership") / 6.0 * 100.0 AS value_p
    FROM imet.eval_governance_leadership
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all_4.formid,
           get_imet_evaluation_stats_table_all_4.section,
           get_imet_evaluation_stats_table_all_4.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all_4('PR5'::text, 'eval_administrative_management'::text, 'EvaluationScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_cm_pr6.formid,
           get_imet_evaluation_stats_cm_pr6.section,
           get_imet_evaluation_stats_cm_pr6.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr6('PR6'::text, 'eval_equipment_maintenance'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr1,
           round(c.value_p::numeric, 2) AS pr2,
           round(d.value_p::numeric, 2) AS pr3,
           round(e.value_p, 2) AS pr4,
           round(f.value_p::numeric, 2) AS pr5,
           round(g.value_p::numeric, 2) AS pr6
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
                tableall.pr1,
                tableall.pr2,
                tableall.pr3,
                tableall.pr4,
                tableall.pr5,
                tableall.pr6
FROM tableall;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr7_pr9
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table7 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('PR7'::text, 'eval_management_activities'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table8 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR8'::text, 'eval_law_enforcement_implementation'::text, 'Adequacy'::text, NULL::text)
), table9 AS (
    SELECT get_imet_evaluation_stats_group_all_fix.formid,
           get_imet_evaluation_stats_group_all_fix.section,
           get_imet_evaluation_stats_group_all_fix.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix('PR9'::text, 'eval_intelligence_implementation'::text, 'Adequacy'::text, 'group_key'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr7,
           round(c.value_p::numeric, 2) AS pr8,
           round(d.value_p::numeric, 2) AS pr9
    FROM table0 a
             LEFT JOIN table7 b ON a.formid = b.formid
             LEFT JOIN table8 c ON a.formid = c.formid
             LEFT JOIN table9 d ON a.formid = d.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.pr7,
                tableall.pr8,
                tableall.pr9
FROM tableall;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr10_pr12
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table10 AS (
    SELECT get_imet_evaluation_stats_cm_pr10.formid,
           get_imet_evaluation_stats_cm_pr10.section,
           get_imet_evaluation_stats_cm_pr10.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr10('PR10'::text, 'eval_stakeholder_cooperation'::text, 'Cooperation'::text, 'group_key'::text, NULL::text)
), table11 AS (
    SELECT get_imet_evaluation_stats_group_all_fix.formid,
           get_imet_evaluation_stats_group_all_fix.section,
           get_imet_evaluation_stats_group_all_fix.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix('PR11'::text, 'eval_assistance_activities'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table12 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR12'::text, 'eval_actors_relations'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr10,
           round(c.value_p::numeric, 2) AS pr11,
           round(d.value_p::numeric, 2) AS pr12
    FROM table0 a
             LEFT JOIN table10 b ON a.formid = b.formid
             LEFT JOIN table11 c ON a.formid = c.formid
             LEFT JOIN table12 d ON a.formid = d.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.pr10,
                tableall.pr11,
                tableall.pr12
FROM tableall;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr13_pr14
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table13 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR13'::text, 'eval_visitors_management'::text, 'EvaluationScore'::text, NULL::text)
), table14 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR14'::text, 'eval_visitors_impact'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr13,
           round(c.value_p::numeric, 2) AS pr14
    FROM table0 a
             LEFT JOIN table13 b ON a.formid = b.formid
             LEFT JOIN table14 c ON a.formid = c.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.pr13,
                tableall.pr14
FROM tableall;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr15_pr16
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table15 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR15'::text, 'eval_natural_resources_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), table16 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR16'::text, 'eval_research_and_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr15,
           round(c.value_p::numeric, 2) AS pr16
    FROM table0 a
             LEFT JOIN table15 b ON a.formid = b.formid
             LEFT JOIN table16 c ON a.formid = c.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.pr15,
                tableall.pr16
FROM tableall;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr17_pr18
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid
    FROM imet_assessment_v2.v_imet_forms
), table17 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('PR17'::text, 'eval_climate_change_monitoring'::text, 'EvaluationScore'::text, NULL::text)
), table18 AS (
    SELECT get_imet_evaluation_stats_cm_pr18.formid,
           get_imet_evaluation_stats_cm_pr18.section,
           get_imet_evaluation_stats_cm_pr18.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr18('PR18'::text, 'eval_ecosystem_services'::text, 'EvaluationScore'::text, 'group_key'::text, 'spam'::text, NULL::text)
), tableall AS (
    SELECT a.formid,
           round(b.value_p::numeric, 2) AS pr17,
           round(c.value_p::numeric, 2) AS pr18
    FROM table0 a
             LEFT JOIN table17 b ON a.formid = b.formid
             LEFT JOIN table18 c ON a.formid = c.formid
    ORDER BY a.formid
)
SELECT DISTINCT tableall.formid,
                tableall.pr17,
                tableall.pr18
FROM tableall;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr1_pr6(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr1_pr6
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr1_pr6  where formid=form_id;
END;
$$;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr7_pr9(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr7_pr9
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr7_pr9  where formid=form_id;
END;
$$;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr10_pr12(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr10_pr12
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr10_pr12  where formid=form_id;
END;
$$;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr13_pr14(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr13_pr14
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr13_pr14 where formid=form_id;
END;
$$;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr15_pr16(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr15_pr16
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr15_pr16 where formid=form_id;
END;
$$;


CREATE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_process_pr17_pr18(
    form_id integer DEFAULT NULL::integer)
    RETURNS SETOF imet_assessment_v2.v_imet_eval_stat_process_pr17_pr18
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    return query select * from imet_assessment_v2.v_imet_eval_stat_process_pr17_pr18 where formid=form_id;
END;
$$;


CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step1
AS
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
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c2('C2'::text, 'eval_supports_and_constaints'::text, NULL::text)
), table_c3 AS (
    SELECT get_imet_evaluation_stats_cm_c3.formid,
           get_imet_evaluation_stats_cm_c3.section,
           get_imet_evaluation_stats_cm_c3.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c3('C3'::text, 'context_menaces_pressions'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_cm_c12.formid,
           get_imet_evaluation_stats_cm_c12.section,
           get_imet_evaluation_stats_cm_c12.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c12('C1.1'::text, 'eval_importance_c12'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_cm_c13.formid,
           get_imet_evaluation_stats_cm_c13.section,
           get_imet_evaluation_stats_cm_c13.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c13('C1.2'::text, 'eval_importance_c13'::text, NULL::text)
), table4 AS (
    SELECT get_imet_evaluation_stats_cm_c14.formid,
           get_imet_evaluation_stats_cm_c14.section,
           get_imet_evaluation_stats_cm_c14.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c14('C1.3'::text, 'eval_importance_c14'::text, NULL::text)
), table5 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('C1.4'::text, 'eval_importance_c15'::text, 'EvaluationScore'::text, NULL::text)
), table6 AS (
    SELECT get_imet_evaluation_stats_cm_c15.formid,
           get_imet_evaluation_stats_cm_c15.section,
           get_imet_evaluation_stats_cm_c15.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c15('C1.5'::text, 'eval_importance_c16'::text, NULL::text)
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

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step2
AS
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
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P1'::text, 'eval_regulations_adequacy'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P2'::text, 'eval_design_adequacy'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_cm_p3.formid,
           get_imet_evaluation_stats_cm_p3.section,
           get_imet_evaluation_stats_cm_p3.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_p3('EVAL P3'::text, 'eval_boundary_level_v2'::text, NULL::text)
), table4 AS (
    SELECT eval_management_plan."FormID" AS formid,
           'P4' AS section,
           100.0 * ((eval_management_plan."PlanExistence"::integer
               + coalesce(eval_management_plan."PlanUptoDate"::integer, 0)
               + coalesce(eval_management_plan."PlanApproved"::integer, 0)
               + coalesce(eval_management_plan."PlanImplemented"::integer, 0)
                        )::numeric
               + coalesce(eval_management_plan."VisionAdequacy", 0)
               + coalesce( eval_management_plan."PlanAdequacyScore", 0)
               ) / (10.0 - nullif(
                       (coalesce(1 - (eval_management_plan."VisionAdequacy"/nullif(eval_management_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_management_plan."PlanAdequacyScore"/nullif(eval_management_plan."PlanAdequacyScore", 0)), 3)
                   ) ,0)) AS value_p
    FROM imet.eval_management_plan
), table5 AS (
    SELECT eval_work_plan."FormID" AS formid,
           'P5' AS section,
           100.0 * ((eval_work_plan."PlanExistence"::integer
               + coalesce(eval_work_plan."PlanUptoDate"::integer, 0)
               + coalesce(eval_work_plan."PlanApproved"::integer, 0)
               + coalesce(eval_work_plan."PlanImplemented"::integer, 0)
                        )::numeric
               + coalesce(eval_work_plan."VisionAdequacy", 0)
               + coalesce( eval_work_plan."PlanAdequacyScore", 0)
               ) / (10.0 - nullif(
                       (coalesce(1 - (eval_work_plan."VisionAdequacy"/nullif(eval_work_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_work_plan."PlanAdequacyScore"/nullif(eval_work_plan."PlanAdequacyScore", 0)), 3))
               , 0)) AS value_p
    FROM imet.eval_work_plan
), table6 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('P6'::text, 'eval_objectives'::text, 'EvaluationScore'::text, NULL::text) get_imet_evaluation_stats_table_all(formid, section, value_p)
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
                round(((COALESCE(tableall.p1, 0::numeric) + COALESCE(tableall.p2, 0::numeric) + COALESCE(tableall.p3, 0::numeric) + COALESCE(tableall.p4, 0::numeric) + COALESCE(tableall.p5, 0::numeric) + COALESCE(tableall.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                                                                                                             FROM ( VALUES (tableall.p1), (tableall.p2), (tableall.p3), (tableall.p4), (tableall.p5), (tableall.p6)) v(col)
                                                                                                                                                                                                                                                                             WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
FROM tableall
ORDER BY tableall.iso3, tableall.name;

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step3
AS
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
    FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('EVAL I1'::text, 'eval_information_availability'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_cm_i2.formid,
           get_imet_evaluation_stats_cm_i2.section,
           get_imet_evaluation_stats_cm_i2.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i2('EVAL I2'::text, 'eval_staff'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_rank_all('eval_budget_adequacy'::text, 'EvaluationScore'::text, 'EVAL I3'::text, NULL::text)
), table4 AS (
    SELECT eval_budget_securization."FormID" AS formid,
           'EVAL I4' AS section,
           (eval_budget_securization."Percentage" / 5::numeric + eval_budget_securization."EvaluationScore" / 3::numeric) / 2::numeric * 100.0 AS value_p
    FROM imet.eval_budget_securization
), table5 AS (
    SELECT get_imet_evaluation_stats_cm_i5.formid,
           get_imet_evaluation_stats_cm_i5.section,
           get_imet_evaluation_stats_cm_i5.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i5('EVAL I5'::text, 'eval_management_equipment_adequacy'::text, 'Importance'::text, NULL::text) get_imet_evaluation_stats_cm_i5(formid, section, value_p)
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
), tableall AS (
    SELECT DISTINCT a.formid,
                    a.wdpa_id,
                    a.iso3,
                    a.name,
                    b.pr1,
                    b.pr2,
                    b.pr3,
                    b.pr4,
                    b.pr5,
                    b.pr6,
                    c.pr7,
                    c.pr8,
                    c.pr9,
                    d.pr10,
                    d.pr11,
                    d.pr12,
                    e.pr13,
                    e.pr14,
                    f.pr15,
                    f.pr16,
                    g.pr17,
                    g.pr18
    FROM table0 a
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr1_pr6 b ON b.formid = a.formid
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr7_pr9 c ON c.formid = a.formid
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr10_pr12 d ON d.formid = a.formid
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr13_pr14 e ON e.formid = a.formid
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr15_pr16 f ON f.formid = a.formid
             LEFT JOIN imet_assessment_v2.v_imet_eval_stat_process_pr17_pr18 g ON g.formid = a.formid
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

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step5
AS
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
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/P1'::text, 'eval_work_program_implementation'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_table_all.formid,
           get_imet_evaluation_stats_table_all.section,
           get_imet_evaluation_stats_table_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/P2'::text, 'eval_achieved_results'::text, 'EvaluationScore'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_cm_op3.formid,
           get_imet_evaluation_stats_cm_op3.section,
           get_imet_evaluation_stats_cm_op3.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_op3('O/P3'::text, 'eval_area_domination'::text, NULL::text)
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

CREATE OR REPLACE VIEW imet_assessment_v2.v_imet_eval_stat_step6
AS
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
    FROM imet_assessment_v2.get_imet_evaluation_stats_table_all('O/C1'::text, 'eval_achived_objectives'::text, 'EvaluationScore'::text, NULL::text)
), table2 AS (
    SELECT get_imet_evaluation_stats_cm_oc2.formid,
           get_imet_evaluation_stats_cm_oc2.section,
           get_imet_evaluation_stats_cm_oc2.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_cm_oc2('O/C2'::text, 'eval_key_conservation_trends'::text, 'Condition'::text, 'Trend'::text, NULL::text)
), table3 AS (
    SELECT get_imet_evaluation_stats_group_all.formid,
           get_imet_evaluation_stats_group_all.section,
           get_imet_evaluation_stats_group_all.value_p
    FROM imet_assessment_v2.get_imet_evaluation_stats_group_all('O/C3'::text, 'eval_life_quality_impact'::text, 'EvaluationScore'::text, 'group_key'::text, NULL::text)
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


CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_forms(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, "Year" integer, wdpa_id integer, iso3 text, name text)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text;

BEGIN

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
    else
        wherea:= '';
    end if;

    if c_iso3 is not null then
        if form_id is not null then
            wherea:= wherea || ' and "Country" = '''||c_iso3||''' ';
        else
            wherea:= ' where "Country" =  '''||c_iso3||''' ';
        end if;
    end if;

    sql := ' SELECT imet_form."FormID" AS formid,
				imet_form."Year",
				imet_form.wdpa_id,
				imet_form."Country" as iso3,
				imet_form.name
			   FROM imet.imet_form
			   '||wherea||';';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr1_pr6(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    whereb text DEFAULT '';
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        whereb:=  ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;


    sql := ' WITH table0 AS (
		SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_cm_pr1.formid,
            get_imet_evaluation_stats_cm_pr1.section,
            get_imet_evaluation_stats_cm_pr1.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr1(''PR1''::text, ''eval_staff_competence''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR2''::text, ''eval_hr_management_politics''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR3''::text, ''eval_hr_management_systems''::text, ''EvaluationScore''::text '||parameters||')
        ), table4 AS (
         SELECT eval_governance_leadership."FormID" AS formid,
            ''PR4'' AS section,
            (eval_governance_leadership."EvaluationScoreGovernace" + eval_governance_leadership."EvaluationScoreLeadership") / 6.0 * 100.0 AS value_p
           FROM imet.eval_governance_leadership
		   '||whereb||'
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all_4.formid,
            get_imet_evaluation_stats_table_all_4.section,
            get_imet_evaluation_stats_table_all_4.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all_4(''PR5''::text, ''eval_administrative_management''::text, ''EvaluationScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_cm_pr6.formid,
            get_imet_evaluation_stats_cm_pr6.section,
            get_imet_evaluation_stats_cm_pr6.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr6(''PR6''::text, ''eval_equipment_maintenance''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr1,
            round(c.value_p::numeric, 2) AS pr2,
            round(d.value_p::numeric, 2) AS pr3,
            round(e.value_p, 2) AS pr4,
            round(f.value_p::numeric, 2) AS pr5,
            round(g.value_p::numeric, 2) AS pr6
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr1,
    tableall.pr2,
    tableall.pr3,
    tableall.pr4,
    tableall.pr5,
    tableall.pr6
   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr7_pr9(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr7 numeric, pr8 numeric, pr9 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table7 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_group_all(''PR7''::text, ''eval_management_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table8 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR8''::text, ''eval_law_enforcement_implementation''::text, ''Adequacy''::text '||parameters||')
        ), table9 AS (
         SELECT get_imet_evaluation_stats_group_all_fix.formid,
            get_imet_evaluation_stats_group_all_fix.section,
            get_imet_evaluation_stats_group_all_fix.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix(''PR9''::text, ''eval_intelligence_implementation''::text, ''Adequacy''::text, ''group_key''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr7,
            round(c.value_p::numeric, 2) AS pr8,
            round(d.value_p::numeric, 2) AS pr9
           FROM table0 a
             LEFT JOIN table7 b ON a.formid = b.formid
             LEFT JOIN table8 c ON a.formid = c.formid
             LEFT JOIN table9 d ON a.formid = d.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr7,
    tableall.pr8,
    tableall.pr9
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr10_pr12(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr10 numeric, pr11 numeric, pr12 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table10 AS (
         SELECT get_imet_evaluation_stats_cm_pr10.formid,
            get_imet_evaluation_stats_cm_pr10.section,
            get_imet_evaluation_stats_cm_pr10.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr10(''PR10''::text, ''eval_stakeholder_cooperation''::text, ''Cooperation''::text, ''group_key''::text '||parameters||')
        ), table11 AS (
         SELECT get_imet_evaluation_stats_group_all_fix.formid,
            get_imet_evaluation_stats_group_all_fix.section,
            get_imet_evaluation_stats_group_all_fix.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_group_all_fix(''PR11''::text, ''eval_assistance_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table12 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR12''::text, ''eval_actors_relations''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr10,
            round(c.value_p::numeric, 2) AS pr11,
            round(d.value_p::numeric, 2) AS pr12
           FROM table0 a
             LEFT JOIN table10 b ON a.formid = b.formid
             LEFT JOIN table11 c ON a.formid = c.formid
             LEFT JOIN table12 d ON a.formid = d.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr10,
    tableall.pr11,
    tableall.pr12
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr13_pr14(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr13 numeric, pr14 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table13 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR13''::text, ''eval_visitors_management''::text, ''EvaluationScore''::text '||parameters||')
        ), table14 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR14''::text, ''eval_visitors_impact''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr13,
            round(c.value_p::numeric, 2) AS pr14
           FROM table0 a
             LEFT JOIN table13 b ON a.formid = b.formid
             LEFT JOIN table14 c ON a.formid = c.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr13,
    tableall.pr14
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr15_pr16(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr15 numeric, pr16 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table15 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR15''::text, ''eval_natural_resources_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table16 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR16''::text, ''eval_research_and_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr15,
            round(c.value_p::numeric, 2) AS pr16
           FROM table0 a
             LEFT JOIN table15 b ON a.formid = b.formid
             LEFT JOIN table16 c ON a.formid = c.formid
          ORDER BY a.formid
        )
		 SELECT DISTINCT tableall.formid,
			tableall.pr15,
			tableall.pr16
		   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr17_pr18(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr17 numeric, pr18 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text DEFAULT '';
    parameters text DEFAULT ', NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ', '''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||''' ';
    end if;


    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
			), table17 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''PR17''::text, ''eval_climate_change_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table18 AS (
         SELECT get_imet_evaluation_stats_cm_pr18.formid,
            get_imet_evaluation_stats_cm_pr18.section,
            get_imet_evaluation_stats_cm_pr18.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_pr18(''PR18''::text, ''eval_ecosystem_services''::text, ''EvaluationScore''::text, ''group_key''::text, ''spam''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr17,
            round(c.value_p::numeric, 2) AS pr18
           FROM table0 a
             LEFT JOIN table17 b ON a.formid = b.formid
             LEFT JOIN table18 c ON a.formid = c.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr17,
    tableall.pr18
   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_summary(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, year integer, iso3 text, name text, context numeric, planning numeric, inputs numeric, process numeric, outputs numeric, outcomes numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters := parameters || ',' || ''''||c_iso3||'''';
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
         SELECT get_imet_forms.formid,
				get_imet_forms."Year" as year,
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT a.formid,
            a.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step1('||parameters||') a
        ), table2 AS (
         SELECT b.formid,
            b.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step2('||parameters||') b
        ), table3 AS (
         SELECT c.formid,
            c.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step3('||parameters||') c
        ), table4 AS (
         SELECT d.formid,
            d.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step4('||parameters||') d
        ), table5 AS (
         SELECT e.formid,
            e.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step5('||parameters||') e
        ), table6 AS (
         SELECT f.formid,
            f.avg_indicator
           FROM imet_assessment_v2.get_imet_evaluation_stats_by_formid_step6('||parameters||') f
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
   FROM tableall;';



    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step1(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, c1 numeric, c2 numeric, c3 numeric, c11 numeric, c12 numeric, c13 numeric, c14 numeric, c15 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text;
    parameters text DEFAULT ', NULL';
    form_parameters text DEFAULT 'NULL';

BEGIN

    if form_id is not null then
        parameters := ', '''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||''' ';
    else
        form_parameters := form_parameters || ', NULL';
    end if;
    raise notice 'form_id: %,%',form_id,c_iso3;

    sql := ' WITH table0 AS (
	  SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
	  ), table_c2 AS (
	 SELECT get_imet_evaluation_stats_cm_c2.formid,
		get_imet_evaluation_stats_cm_c2.section,
		get_imet_evaluation_stats_cm_c2.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c2(''C2''::text, ''eval_supports_and_constaints''::text '||parameters||')
	), table_c3 AS (
	 SELECT get_imet_evaluation_stats_cm_c3.formid,
		get_imet_evaluation_stats_cm_c3.section,
		get_imet_evaluation_stats_cm_c3.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c3(''C3''::text, ''context_menaces_pressions''::text '||parameters||')
	), table2 AS (
	 SELECT get_imet_evaluation_stats_cm_c12.formid,
		get_imet_evaluation_stats_cm_c12.section,
		get_imet_evaluation_stats_cm_c12.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c12(''C1.1''::text, ''eval_importance_c12''::text '||parameters||')
	), table3 AS (
	 SELECT get_imet_evaluation_stats_cm_c13.formid,
		get_imet_evaluation_stats_cm_c13.section,
		get_imet_evaluation_stats_cm_c13.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c13(''C1.2''::text, ''eval_importance_c13''::text '||parameters||')
	), table4 AS (
	 SELECT get_imet_evaluation_stats_cm_c14.formid,
		get_imet_evaluation_stats_cm_c14.section,
		get_imet_evaluation_stats_cm_c14.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c14(''C1.3''::text, ''eval_importance_c14''::text '||parameters||')
	), table5 AS (
	 SELECT get_imet_evaluation_stats_table_all.formid,
		get_imet_evaluation_stats_table_all.section,
		get_imet_evaluation_stats_table_all.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''C1.4''::text, ''eval_importance_c15''::text, ''EvaluationScore''::text '||parameters||')
	), table6 AS (
	 SELECT get_imet_evaluation_stats_cm_c15.formid,
		get_imet_evaluation_stats_cm_c15.section,
		get_imet_evaluation_stats_cm_c15.value_p
	   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_c15(''C1.5''::text, ''eval_importance_c16''::text '||parameters||')
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
   ORDER BY tableall.iso3, tableall.name;';
    raise notice 'sql: %',sql;
    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step2(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, p1 numeric, p2 numeric, p3 numeric, p4 numeric, p5 numeric, p6 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text DEFAULT '';
    parameters text DEFAULT ', NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        wherea:= ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
        parameters := ', '''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||''' ';
    end if;

    sql := ' WITH table0 AS (
	  SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
         ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''P1''::text, ''eval_regulations_adequacy''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''P2''::text, ''eval_design_adequacy''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_cm_p3.formid,
            get_imet_evaluation_stats_cm_p3.section,
            get_imet_evaluation_stats_cm_p3.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_p3(''EVAL P3''::text, ''eval_boundary_level_v2''::text '||parameters||')
        ), table4 AS (
         SELECT eval_management_plan."FormID" AS formid,
            ''P4'' AS section,
                100.0 * ((eval_management_plan."PlanExistence"::integer
                     + coalesce(eval_management_plan."PlanUptoDate"::integer, 0)
                     + coalesce(eval_management_plan."PlanApproved"::integer, 0)
                     + coalesce(eval_management_plan."PlanImplemented"::integer, 0)
                )::numeric
                    + coalesce(eval_management_plan."VisionAdequacy", 0)
                    + coalesce( eval_management_plan."PlanAdequacyScore", 0)
                ) / (10.0 - nullif(
                       (coalesce(1 - (eval_management_plan."VisionAdequacy"/nullif(eval_management_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_management_plan."PlanAdequacyScore"/nullif(eval_management_plan."PlanAdequacyScore", 0)), 3)
                   ) ,0)) AS value_p
           FROM imet.eval_management_plan
		    '||wherea||'
        ), table5 AS (
         SELECT eval_work_plan."FormID" AS formid,
            ''P5'' AS section,
            100.0 * ((eval_work_plan."PlanExistence"::integer
                     + coalesce(eval_work_plan."PlanUptoDate"::integer, 0)
                     + coalesce(eval_work_plan."PlanApproved"::integer, 0)
                     + coalesce(eval_work_plan."PlanImplemented"::integer, 0)
                )::numeric
                    + coalesce(eval_work_plan."VisionAdequacy", 0)
                    + coalesce( eval_work_plan."PlanAdequacyScore", 0)
            ) / (10.0 - nullif(
                       (coalesce(1 - (eval_work_plan."VisionAdequacy"/nullif(eval_work_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_work_plan."PlanAdequacyScore"/nullif(eval_work_plan."PlanAdequacyScore", 0)), 3))
               , 0)) AS value_p
           FROM imet.eval_work_plan
		    '||wherea||'
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''P6''::text, ''eval_objectives''::text, ''EvaluationScore''::text '||parameters||')
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
    round(((COALESCE(tableall.p1, 0::numeric) + COALESCE(tableall.p2, 0::numeric) + COALESCE(tableall.p3, 0::numeric) + COALESCE(tableall.p4, 0::numeric) + COALESCE(tableall.p5, 0::numeric) + COALESCE(tableall.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (tableall.p1), (tableall.p2), (tableall.p3), (tableall.p4), (tableall.p5), (tableall.p6)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM tableall
  ORDER BY tableall.iso3, tableall.name;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step3(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, i1 numeric, i2 numeric, i3 numeric, i4 numeric, i5 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text DEFAULT '';
    parameters text DEFAULT ', NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        wherea:= ' where eval_budget_securization."FormID" = ANY(''{'||form_id||'}''::int[]) ';
        parameters := ', '''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||''' ';
    end if;

    sql := ' WITH table0 AS (
      SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
	   ), table1 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_group_all(''EVAL I1''::text, ''eval_information_availability''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_i2.formid,
            get_imet_evaluation_stats_cm_i2.section,
            get_imet_evaluation_stats_cm_i2.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i2(''EVAL I2''::text, ''eval_staff''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_rank_all(''eval_budget_adequacy''::text, ''EvaluationScore''::text, ''EVAL I3''::text '||parameters||')
        ), table4 AS (
         SELECT eval_budget_securization."FormID" AS formid,
            ''EVAL I4'' AS section,
            (eval_budget_securization."Percentage" / 5::numeric + eval_budget_securization."EvaluationScore" / 3::numeric) / 2::numeric * 100.0 AS value_p
           FROM imet.eval_budget_securization
		   '||wherea||'
        ), table5 AS (
         SELECT get_imet_evaluation_stats_cm_i5.formid,
            get_imet_evaluation_stats_cm_i5.section,
            get_imet_evaluation_stats_cm_i5.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_i5(''EVAL I5''::text, ''eval_management_equipment_adequacy''::text, ''Importance''::text '||parameters||')
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
  ORDER BY tableall.iso3, tableall.name;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step4(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric, pr7 numeric, pr8 numeric, pr9 numeric, pr10 numeric, pr11 numeric, pr12 numeric, pr13 numeric, pr14 numeric, pr15 numeric, pr16 numeric, pr17 numeric, pr18 numeric, pr1_6 numeric, pr7_9 numeric, pr10_12 numeric, pr13_14 numeric, pr15_16 numeric, pr17_18 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters := parameters || ',' || ''''||c_iso3||'''';
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
         SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), tableall AS (
         SELECT DISTINCT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            b.pr1,
            b.pr2,
            b.pr3,
            b.pr4,
            b.pr5,
            b.pr6,
            c.pr7,
            c.pr8,
            c.pr9,
            d.pr10,
            d.pr11,
            d.pr12,
            e.pr13,
            e.pr14,
            f.pr15,
            f.pr16,
            g.pr17,
            g.pr18
           FROM table0 a
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr1_pr6('||parameters||') b ON b.formid = a.formid
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr7_pr9('||parameters||') c ON c.formid = a.formid
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr10_pr12('||parameters||') d ON d.formid = a.formid
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr13_pr14('||parameters||') e ON e.formid = a.formid
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr15_pr16('||parameters||') f ON f.formid = a.formid
             LEFT JOIN imet_assessment_v2.get_imet_evaluation_stats_step_by_formid_process_pr17_pr18('||parameters||') g ON g.formid = a.formid
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
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step5(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, op1 numeric, op2 numeric, op3 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;


    sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
			), table1 AS (
			 SELECT get_imet_evaluation_stats_table_all.formid,
				get_imet_evaluation_stats_table_all.section,
				get_imet_evaluation_stats_table_all.value_p
			   FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''O/P1''::text, ''eval_work_program_implementation''::text, ''EvaluationScore''::text '||parameters||')
			), table2 AS (
			 SELECT get_imet_evaluation_stats_table_all.formid,
				get_imet_evaluation_stats_table_all.section,
				get_imet_evaluation_stats_table_all.value_p
			   FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''O/P2''::text, ''eval_achieved_results''::text, ''EvaluationScore''::text '||parameters||')
			), table3 AS (
			 SELECT get_imet_evaluation_stats_cm_op3.formid,
				get_imet_evaluation_stats_cm_op3.section,
				get_imet_evaluation_stats_cm_op3.value_p
			   FROM imet_assessment_v2.get_imet_evaluation_stats_cm_op3(''O/P3''::text, ''eval_area_domination''::text '||parameters||')
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
			 FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_by_formid_step6(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, oc1 numeric, oc2 numeric, oc3 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
			 SELECT get_imet_forms.formid,
				get_imet_forms."Year",
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  			FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
			), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_table_all(''O/C1''::text, ''eval_achived_objectives''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_oc2.formid,
            get_imet_evaluation_stats_cm_oc2.section,
            get_imet_evaluation_stats_cm_oc2.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_cm_oc2(''O/C2''::text, ''eval_key_conservation_trends''::text, ''Condition''::text, ''Trend''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment_v2.get_imet_evaluation_stats_group_all(''O/C3''::text, ''eval_life_quality_impact''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
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
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;



-- ###############################################
-- ###############################################
-- ###############################################

CREATE SCHEMA IF NOT EXISTS imet_assessment_v1_to_v2;

CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_condition_stat_step_2_p3(p_value double precision) RETURNS double precision
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
BEGIN
    CASE WHEN p_value = 0
             THEN RETURN 1;
         WHEN p_value <= 25
             THEN RETURN 0.8*p_value;
         WHEN p_value <= 62.5
             THEN RETURN (20+(p_value-25)/(62.5-25)*40);
         WHEN p_value <= 87.5
             THEN RETURN (60+(p_value-62.5)/(87.5-62.5)*30);
         ELSE RETURN (90+(p_value-87.5)/12.5*10);
        END CASE;

END;
$$;

CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_condition_stat_step_2_p3(
    p_value numeric)
    RETURNS numeric
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
BEGIN
    CASE WHEN p_value = 0
             THEN RETURN 0;
         WHEN p_value <= 25
             THEN RETURN 0.8*p_value;
         WHEN p_value <= 62.5
             THEN RETURN (20+(p_value-25)/(62.5-25)*40);
         WHEN p_value <= 87.5
             THEN RETURN (60+(p_value-62.5)/(87.5-62.5)*30);
         ELSE RETURN (90+(p_value-87.5)/12.5*10);
        END CASE;

END;
$$;

CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i3(
    p_value double precision)
    RETURNS double precision
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
BEGIN
    CASE WHEN p_value = 0
             THEN RETURN 0;
         WHEN p_value <= 17.5
             THEN RETURN (26/17.5)*p_value;
         WHEN p_value <= 53
             THEN RETURN (26+(p_value-17.5)/(53-17.5)*26);
         WHEN p_value <= 85.5
             THEN RETURN (52+(p_value-53)/(85.5-53)*34);
         ELSE RETURN (86+(p_value-85.5)/14.5*14);
        END CASE;

END;
$$;

CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i4(
    p_value double precision)
    RETURNS double precision
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
BEGIN
    CASE WHEN p_value = 0
             THEN RETURN 0;
         WHEN p_value <= 16.7
             THEN RETURN (5/16.7)*p_value;
         WHEN p_value <= 50
             THEN RETURN (5+(p_value-16.7)/(50-16.7)*31.6666667);
         WHEN p_value <= 83.3
             THEN RETURN (36.666667+(p_value-50)/(83.3-50)*36.66666667);
         ELSE RETURN (73.333333333+(p_value-83.3)/16.7*26.6666666666667);
        END CASE;

END;
$$;


CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_stat_labels(
)
    RETURNS TABLE(code text, code_label text, title_fr text, title_en text, title_sp text)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
declare
    sql text;

BEGIN

    sql:= 'SELECT code::text, code_label::text,title_fr::text,title_en::text,title_sp::text from imet.imet_metadata_statistics WHERE version=''v1'';';

    RETURN QUERY EXECUTE sql;
END;
$$;


CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step1
AS
WITH table0 AS (
    SELECT DISTINCT v_imet_eval_stat_step1.formid,
                    v_imet_eval_stat_step1.wdpa_id,
                    v_imet_eval_stat_step1.iso3,
                    v_imet_eval_stat_step1.name,
                    round(((COALESCE(v_imet_eval_stat_step1.c12::double precision, 0::double precision) + COALESCE(v_imet_eval_stat_step1.c13::double precision, 0::double precision) + COALESCE(v_imet_eval_stat_step1.c14::double precision, 0::double precision) + COALESCE(v_imet_eval_stat_step1.c15::double precision, 0::double precision) + COALESCE(v_imet_eval_stat_step1.c16::double precision, 0::double precision)) / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                                                                                                                                             FROM ( VALUES (v_imet_eval_stat_step1.c12), (v_imet_eval_stat_step1.c13), (v_imet_eval_stat_step1.c14), (v_imet_eval_stat_step1.c15), (v_imet_eval_stat_step1.c16)) v(col)
                                                                                                                                                                                                                                                                                                                                                                                                                                             WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 2) AS c1,
                    v_imet_eval_stat_step1.c2,
                    v_imet_eval_stat_step1.c3,
                    v_imet_eval_stat_step1.c12 AS c11,
                    v_imet_eval_stat_step1.c13 AS c12,
                    v_imet_eval_stat_step1.c14 AS c13,
                    v_imet_eval_stat_step1.c15 AS c14,
                    v_imet_eval_stat_step1.c16 AS c15
    FROM imet_assessment.v_imet_eval_stat_step1
)
SELECT DISTINCT table0.formid,
                table0.wdpa_id,
                table0.iso3,
                table0.name,
                table0.c1,
                table0.c2,
                table0.c3,
                table0.c11,
                table0.c12,
                table0.c13,
                table0.c14,
                table0.c15,
                round(((COALESCE(table0.c1, 0::numeric) + COALESCE(table0.c2, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.c3, 0::numeric) + 100.0)::double precision / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                FROM ( VALUES (table0.c1), (table0.c2), (table0.c3)) v(col)
                                                                                                                                                                                WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
FROM table0
ORDER BY table0.iso3, table0.name;

CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step2
AS
WITH table0 AS (
    SELECT DISTINCT v_imet_eval_stat_step2.formid,
                    v_imet_eval_stat_step2.wdpa_id,
                    v_imet_eval_stat_step2.iso3,
                    v_imet_eval_stat_step2.name,
                    v_imet_eval_stat_step2.p1,
                    v_imet_eval_stat_step2.p2,
                    round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_2_p3(v_imet_eval_stat_step2.p3), 2) AS p3,
                    v_imet_eval_stat_step2.p4 * 0.92 AS p4,
                    v_imet_eval_stat_step2.p5 * 0.837 AS p5,
                    v_imet_eval_stat_step2.p6
    FROM imet_assessment.v_imet_eval_stat_step2
)
SELECT DISTINCT table0.formid,
                table0.wdpa_id,
                table0.iso3,
                table0.name,
                table0.p1,
                table0.p2,
                table0.p3,
                round(table0.p4, 2) AS p4,
                round(table0.p5, 2) AS p5,
                table0.p6,
                round(((COALESCE(table0.p1, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.p2, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.p3, 0::numeric) + COALESCE(table0.p4, 0::numeric) + COALESCE(table0.p5, 0::numeric) + COALESCE(table0.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                           FROM ( VALUES (table0.p1), (table0.p2), (table0.p3), (table0.p4), (table0.p5), (table0.p6)) v(col)
                                                                                                                                                                                                                                                                                           WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
FROM table0
ORDER BY table0.iso3, table0.name;



CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step3
AS
WITH table0 AS (
    SELECT v_imet_eval_stat_step3.formid,
           v_imet_eval_stat_step3.wdpa_id,
           v_imet_eval_stat_step3.iso3,
           v_imet_eval_stat_step3.name,
           round(v_imet_eval_stat_step3.i1 * 0.8, 2) AS i1,
           round(v_imet_eval_stat_step3.i2 * 0.91, 2) AS i2,
           round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i3(v_imet_eval_stat_step3.i3::double precision)::numeric, 2) AS i3,
           round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i4(v_imet_eval_stat_step3.i4::double precision)::numeric, 2) AS i4,
           round(v_imet_eval_stat_step3.i5 * 0.893, 2) AS i5
    FROM imet_assessment.v_imet_eval_stat_step3
)
SELECT DISTINCT table0.formid,
                table0.wdpa_id,
                table0.iso3,
                table0.name,
                table0.i1,
                table0.i2,
                table0.i3,
                table0.i4,
                table0.i5,
                round(((COALESCE(table0.i1, 0::numeric) + COALESCE(table0.i2, 0::numeric) + COALESCE(table0.i3, 0::numeric) + COALESCE(table0.i4, 0::numeric) + COALESCE(table0.i5, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                              FROM ( VALUES (table0.i1), (table0.i2), (table0.i3), (table0.i4), (table0.i5)) v(col)
                                                                                                                                                                                                                              WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
FROM table0
ORDER BY table0.iso3, table0.name;

CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step4
AS
WITH table0 AS (
    SELECT v_imet_eval_stat_step4.formid,
           v_imet_eval_stat_step4.wdpa_id,
           v_imet_eval_stat_step4.iso3,
           v_imet_eval_stat_step4.name,
           v_imet_eval_stat_step4.pr1,
           v_imet_eval_stat_step4.pr2,
           v_imet_eval_stat_step4.pr3,
           v_imet_eval_stat_step4.pr4,
           v_imet_eval_stat_step4.pr5,
           round(v_imet_eval_stat_step4.pr6 * 0.8, 2) AS pr6,
           v_imet_eval_stat_step4.pr7,
           v_imet_eval_stat_step4.pr10 AS pr8,
           v_imet_eval_stat_step4.pr10 AS pr9,
           v_imet_eval_stat_step4.pr11 AS pr10,
           v_imet_eval_stat_step4.pr12 AS pr11,
           v_imet_eval_stat_step4.pr13 AS pr12,
           v_imet_eval_stat_step4.pr14 AS pr13,
           v_imet_eval_stat_step4.pr15 AS pr14,
           v_imet_eval_stat_step4.pr16 AS pr15,
           v_imet_eval_stat_step4.pr17 AS pr16,
           v_imet_eval_stat_step4.pr18 AS pr17,
           v_imet_eval_stat_step4.pr19 AS pr18,
           v_imet_eval_stat_step4.pr1_6,
           v_imet_eval_stat_step4.pr7_10,
           v_imet_eval_stat_step4.pr11_13,
           v_imet_eval_stat_step4.pr14_15,
           v_imet_eval_stat_step4.pr16_17,
           0 AS pr18_19
    FROM imet_assessment.v_imet_eval_stat_step4
)
SELECT table0.formid,
       table0.wdpa_id,
       table0.iso3,
       table0.name,
       table0.pr1,
       table0.pr2,
       table0.pr3,
       table0.pr4,
       table0.pr5,
       table0.pr6,
       table0.pr7,
       table0.pr8,
       table0.pr9,
       table0.pr10,
       table0.pr11,
       table0.pr12,
       table0.pr13,
       table0.pr14,
       table0.pr15,
       table0.pr16,
       table0.pr17,
       table0.pr18,
       table0.pr1_6,
       table0.pr7_10,
       table0.pr11_13,
       table0.pr14_15,
       table0.pr16_17,
       table0.pr18_19,
       round(((COALESCE(table0.pr1, 0::numeric) + COALESCE(table0.pr2, 0::numeric) + COALESCE(table0.pr3, 0::numeric) + COALESCE(table0.pr4, 0::numeric) + COALESCE(table0.pr5, 0::numeric) + COALESCE(table0.pr6, 0::numeric) + COALESCE(table0.pr7, 0::numeric) + COALESCE(table0.pr8, 0::numeric) + COALESCE(table0.pr9, 0::numeric) + COALESCE(table0.pr10, 0::numeric) + COALESCE(table0.pr11, 0::numeric) + COALESCE(table0.pr12, 0::numeric) + COALESCE(table0.pr13, 0::numeric) + COALESCE(table0.pr14, 0::numeric) + COALESCE(table0.pr15, 0::numeric) + COALESCE(table0.pr16, 0::numeric) + COALESCE(table0.pr17, 0::numeric) + COALESCE(table0.pr18, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          FROM ( VALUES (table0.pr1), (table0.pr2), (table0.pr3), (table0.pr4), (table0.pr5), (table0.pr6), (table0.pr7), (table0.pr8), (table0.pr9), (table0.pr10), (table0.pr11), (table0.pr12), (table0.pr13), (table0.pr14), (table0.pr15), (table0.pr16), (table0.pr17), (table0.pr18)) v(col)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
FROM table0;

CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step5
AS
WITH table0 AS (
    SELECT DISTINCT v_imet_eval_stat_step5.formid,
                    v_imet_eval_stat_step5.wdpa_id,
                    v_imet_eval_stat_step5.iso3,
                    v_imet_eval_stat_step5.name,
                    v_imet_eval_stat_step5.r1 * 0.76 AS r1,
                    v_imet_eval_stat_step5.r2 * 0.76 AS r2
    FROM imet_assessment.v_imet_eval_stat_step5
), table1 AS (
    SELECT get_imet_evaluation_stats_rank_all.formid,
           get_imet_evaluation_stats_rank_all.section,
           get_imet_evaluation_stats_rank_all.value_p
    FROM imet_assessment.get_imet_evaluation_stats_rank_all('eval_control'::text, 'EvaluationScore'::text, 'EVAL PR9'::text)
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.iso3,
           a.name,
           round(a.r1, 2) AS r1,
           round(a.r2, 2) AS r2,
           b.value_p AS r3
    FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
)
SELECT DISTINCT tableall.formid,
                tableall.wdpa_id,
                tableall.iso3,
                tableall.name,
                tableall.r1,
                tableall.r2,
                tableall.r3,
                round((((COALESCE(tableall.r1, 0::numeric) + COALESCE(tableall.r2, 0::numeric))::double precision + COALESCE(tableall.r3, 0::numeric::double precision)) / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                    FROM ( VALUES (tableall.r1), (tableall.r2), (tableall.r3)) v(col)
                                                                                                                                                                                    WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
FROM tableall;

CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step6
AS
WITH table0 AS (
    SELECT v_imet_eval_stat_step6.formid,
           v_imet_eval_stat_step6.wdpa_id,
           v_imet_eval_stat_step6.iso3,
           v_imet_eval_stat_step6.name,
           v_imet_eval_stat_step6.ei1 * 0.76 AS ei1,
           round(((COALESCE(v_imet_eval_stat_step6.ei2::double precision, 0::numeric::double precision) + COALESCE(v_imet_eval_stat_step6.ei3)::double precision) / 2::double precision)::numeric, 2) AS ei2,
           v_imet_eval_stat_step6.ei4 AS ei3
    FROM imet_assessment.v_imet_eval_stat_step6
)
SELECT DISTINCT table0.formid,
                table0.wdpa_id,
                table0.iso3,
                table0.name,
                table0.ei1,
                table0.ei2,
                table0.ei3,
                round(((COALESCE(table0.ei1, 0::numeric)::double precision + COALESCE(table0.ei2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(table0.ei3::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
                                                                                                                                                                                                                                                                                                             FROM ( VALUES (table0.ei1), (table0.ei2), (table0.ei3)) v(col)
                                                                                                                                                                                                                                                                                                             WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
FROM table0;

CREATE VIEW imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary
AS
WITH table0 AS (
    SELECT v_imet_forms."FormID" AS formid,
           v_imet_forms."Year" AS year,
           v_imet_forms.wdpa_id,
           v_imet_forms.iso3,
           v_imet_forms.name
    FROM imet_assessment.v_imet_forms
), table1 AS (
    SELECT v_imet_eval_stat_step1.formid,
           v_imet_eval_stat_step1.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step1
), table2 AS (
    SELECT v_imet_eval_stat_step2.formid,
           v_imet_eval_stat_step2.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step2
), table3 AS (
    SELECT v_imet_eval_stat_step3.formid,
           v_imet_eval_stat_step3.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step3
), table4 AS (
    SELECT v_imet_eval_stat_step4.formid,
           v_imet_eval_stat_step4.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step4
), table5 AS (
    SELECT v_imet_eval_stat_step5.formid,
           v_imet_eval_stat_step5.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step5
), table6 AS (
    SELECT v_imet_eval_stat_step6.formid,
           v_imet_eval_stat_step6.avg_indicator
    FROM imet_assessment_v1_to_v2.v_imet_eval_stat_step6
), tableall AS (
    SELECT a.formid,
           a.wdpa_id,
           a.year,
           a.iso3,
           a.name,
           b.avg_indicator AS context,
           c.avg_indicator AS plans,
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
                tableall.plans,
                tableall.inputs,
                tableall.process,
                tableall.outputs,
                tableall.outcomes
FROM tableall;

CREATE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_summary(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS SETOF imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
declare
    form_ids text;

BEGIN

    form_ids := '{' || form_id || '}';

    CASE WHEN form_id is not null and c_iso3 is null
             THEN return query select * from imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary where formid=ANY(form_ids::int[]);
         WHEN form_id is null and c_iso3 is not null
             THEN return query select * from imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary where iso3=c_iso3;
         WHEN form_id is not null and c_iso3 is not null
             THEN return query select * from imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary where iso3=c_iso3 and formid=ANY(form_ids::int[]);
         ELSE
             return query select * from imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary;
        END CASE;
END;
$$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr1_pr6(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    whereb text DEFAULT '';
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        whereb:=  ' where "FormID" = ANY(''{'||form_id||'}''::int[]) ';
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
		SELECT
			get_imet_forms.formid,
            get_imet_forms.iso3
		FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_cm_pr1.formid,
            get_imet_evaluation_stats_cm_pr1.section,
            get_imet_evaluation_stats_cm_pr1.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr1(''PR1''::text, ''eval_staff_competence''::text, ''EvaluationScore''::text '||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR2''::text, ''eval_hr_management_politics''::text, ''EvaluationScore''::text '||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR3''::text, ''eval_hr_management_systems''::text, ''EvaluationScore''::text '||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR4''::text, ''eval_governance_leadership''::text, ''EvaluationScoreGovernace''::text '||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR5''::text, ''eval_administrative_management''::text, ''EvaluationScore''::text '||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR6''::text, ''eval_equipment_maintenance''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr1,
            round(c.value_p::numeric, 2) AS pr2,
            round(d.value_p::numeric, 2) AS pr3,
            round(e.value_p::numeric, 2) AS pr4,
            round(f.value_p::numeric, 2) AS pr5,
			round(g.value_p::numeric * 0.8, 2) AS pr6
            FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
             LEFT JOIN table2 c ON a.formid = c.formid
             LEFT JOIN table3 d ON a.formid = d.formid
             LEFT JOIN table4 e ON a.formid = e.formid
             LEFT JOIN table5 f ON a.formid = f.formid
             LEFT JOIN table6 g ON a.formid = g.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr1,
    tableall.pr2,
    tableall.pr3,
    tableall.pr4,
    tableall.pr5,
    tableall.pr6
   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr7_pr9(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr7 numeric, pr8 numeric, pr9 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment.get_imet_forms('||form_parameters||')
        ),table7 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR7''::text, ''eval_management_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table8 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR8''::text, ''eval_protection_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table9 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr7,
            round(c.value_p::numeric, 2) AS pr8,
            round(d.value_p::numeric, 2) AS pr9
           FROM table0 a
             LEFT JOIN table7 b ON a.formid = b.formid
             LEFT JOIN table8 c ON a.formid = c.formid
             LEFT JOIN table9 d ON a.formid = d.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr7,
    tableall.pr8,
    tableall.pr9
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr10_pr12(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr10 numeric, pr11 numeric, pr12 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table10 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR10''::text, ''eval_law_enforcement''::text, ''EvaluationScore''::text '||parameters||')
        ), table11 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR11''::text, ''eval_implications''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table12 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR12''::text, ''eval_assistance_activities''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr10,
            round(c.value_p::numeric, 2) AS pr11,
            round(d.value_p::numeric, 2) AS pr12
           FROM table0 a
             LEFT JOIN table10 b ON a.formid = b.formid
             LEFT JOIN table11 c ON a.formid = c.formid
             LEFT JOIN table12 d ON a.formid = d.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr10,
    tableall.pr11,
    tableall.pr12
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr13_pr14(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr13 numeric, pr14 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table13 AS (
         SELECT get_imet_evaluation_stats_cm_pr13.formid,
            get_imet_evaluation_stats_cm_pr13.section,
            get_imet_evaluation_stats_cm_pr13.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr13(''PR13''::text, ''eval_actors_relations''::text, ''EvaluationScore''::text '||parameters||')
        ), table14 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR14''::text, ''eval_visitors_management''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr13,
            round(c.value_p::numeric, 2) AS pr14
           FROM table0 a
             LEFT JOIN table13 b ON a.formid = b.formid
             LEFT JOIN table14 c ON a.formid = c.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr13,
    tableall.pr14
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr15_pr16(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr15 numeric, pr16 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT ',NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ','''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
        ), table15 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR15''::text, ''eval_visitors_impact''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||')
        ), table16 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR16''::text, ''eval_natural_resources_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr15,
            round(c.value_p::numeric, 2) AS pr16
           FROM table0 a
             LEFT JOIN table15 b ON a.formid = b.formid
             LEFT JOIN table16 c ON a.formid = c.formid
          ORDER BY a.formid
        )
		 SELECT DISTINCT tableall.formid,
			tableall.pr15,
			tableall.pr16
		   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_process_pr17_pr18(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, pr17 numeric, pr18 numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text DEFAULT '';
    parameters text DEFAULT ', NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ', '''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        form_parameters := form_parameters || ', '''||c_iso3||''' ';
    end if;


    sql := 'WITH table0 AS (
         SELECT 	get_imet_forms.formid,
				get_imet_forms.iso3
	  	FROM imet_assessment_v2.get_imet_forms('||form_parameters||')
			), table17 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR17''::text, ''eval_research_and_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), table18 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR18''::text, ''eval_climate_change_monitoring''::text, ''EvaluationScore''::text '||parameters||')
        ), tableall AS (
         SELECT a.formid,
            round(b.value_p::numeric, 2) AS pr17,
            round(c.value_p::numeric, 2) AS pr18
           FROM table0 a
             LEFT JOIN table17 b ON a.formid = b.formid
             LEFT JOIN table18 c ON a.formid = c.formid
          ORDER BY a.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.pr17,
    tableall.pr18
   FROM tableall;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;


CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step1(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, c1 numeric, c2 numeric, c3 numeric, c11 numeric, c12 numeric, c13 numeric, c14 numeric, c15 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
         SELECT DISTINCT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            round(((COALESCE(A.c12::double precision, 0::double precision) + COALESCE(A.c13::double precision, 0::double precision) + COALESCE(A.c14::double precision, 0::double precision) + COALESCE(A.c15::double precision, 0::double precision) + COALESCE(A.c16::double precision, 0::double precision)) / NULLIF((( SELECT count(*) AS count
                   FROM ( VALUES (A.c12), (A.c13), (A.c14), (A.c15), (A.c16)) v(col)
                  WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 2) AS c1,
            A.c2,
            A.c3,
            A.c12 AS c11,
            A.c13 AS c12,
            A.c14 AS c13,
            A.c15 AS c14,
            A.c16 AS c15
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step1('||parameters||') AS A
        )
 SELECT DISTINCT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.c1,
    table0.c2,
    table0.c3,
    table0.c11,
    table0.c12,
    table0.c13,
    table0.c14,
    table0.c15,
    round(((COALESCE(table0.c1, 0::numeric) + COALESCE(table0.c2, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.c3, 0::numeric) + 100.0)::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (table0.c1), (table0.c2), (table0.c3)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM table0
  ORDER BY table0.iso3, table0.name;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step2(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, p1 numeric, p2 numeric, p3 numeric, p4 numeric, p5 numeric, p6 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    wherea text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT DISTINCT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.p1,
            A.p2,
            round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_2_p3(A.p3), 2) AS p3,
            A.p4 * 0.92 AS p4,
            A.p5 * 0.837 AS p5,
            A.p6
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step2('||parameters||') AS A
        )
 SELECT DISTINCT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.p1,
    table0.p2,
    table0.p3,
    round(table0.p4, 2) AS p4,
    round(table0.p5, 2) AS p5,
    table0.p6,
    round(((COALESCE(table0.p1, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.p2, 0::numeric) / 2.0 + 50.0 + COALESCE(table0.p3, 0::numeric) + COALESCE(table0.p4, 0::numeric) + COALESCE(table0.p5, 0::numeric) + COALESCE(table0.p6, 0::numeric))::double precision / NULLIF((( SELECT count(*) AS count
           FROM ( VALUES (table0.p1), (table0.p2), (table0.p3), (table0.p4), (table0.p5), (table0.p6)) v(col)
          WHERE v.col IS NOT NULL))::double precision, 0::double precision))::numeric, 1) AS avg_indicator
   FROM table0
  ORDER BY table0.iso3, table0.name;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step3(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, i1 numeric, i2 numeric, i3 numeric, i4 numeric, i5 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            round(A.i1 * 0.8, 2) AS i1,
            round(A.i2 * 0.91, 2) AS i2,
            round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i3(A.i3::double precision)::numeric, 2) AS i3,
            round(imet_assessment_v1_to_v2.get_imet_condition_stat_step_3_i4(A.i4::double precision)::numeric, 2) AS i4,
            round(A.i5 * 0.893, 2) AS i5
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step3('||parameters||') AS A
        )
 SELECT DISTINCT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.i1,
    table0.i2,
    table0.i3,
    table0.i4,
    table0.i5,
    round(((COALESCE(table0.i1, 0::numeric) + COALESCE(table0.i2, 0::numeric) + COALESCE(table0.i3, 0::numeric) + COALESCE(table0.i4, 0::numeric) + COALESCE(table0.i5, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (table0.i1), (table0.i2), (table0.i3), (table0.i4), (table0.i5)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM table0
  ORDER BY table0.iso3, table0.name;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step4(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric, pr7 numeric, pr8 numeric, pr9 numeric, pr10 numeric, pr11 numeric, pr12 numeric, pr13 numeric, pr14 numeric, pr15 numeric, pr16 numeric, pr17 numeric, pr18 numeric, pr1_6 numeric, pr7_10 numeric, pr11_13 numeric, pr14_15 numeric, pr16_17 numeric, pr18_19 integer, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.pr1,
            A.pr2,
            A.pr3,
            A.pr4,
            A.pr5,
            round(A.pr6 * 0.8, 2) AS pr6,
            A.pr7,
            A.pr10 AS pr8,
            A.pr10 AS pr9,
            A.pr11 AS pr10,
            A.pr12 AS pr11,
            A.pr13 AS pr12,
            A.pr14 AS pr13,
            A.pr15 AS pr14,
            A.pr16 AS pr15,
            A.pr17 AS pr16,
            A.pr18 AS pr17,
            A.pr19 AS pr18,
            A.pr1_6,
            A.pr7_10,
            A.pr11_13,
            A.pr14_15,
            A.pr16_17,
            0 AS pr18_19
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step4('||parameters||') AS A
        )
 SELECT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.pr1,
    table0.pr2,
    table0.pr3,
    table0.pr4,
    table0.pr5,
    table0.pr6,
    table0.pr7,
    table0.pr8,
    table0.pr9,
    table0.pr10,
    table0.pr11,
    table0.pr12,
    table0.pr13,
    table0.pr14,
    table0.pr15,
    table0.pr16,
    table0.pr17,
    table0.pr18,
    table0.pr1_6,
    table0.pr7_10,
    table0.pr11_13,
    table0.pr14_15,
    table0.pr16_17,
    table0.pr18_19,
    round(((COALESCE(table0.pr1, 0::numeric) + COALESCE(table0.pr2, 0::numeric) + COALESCE(table0.pr3, 0::numeric) + COALESCE(table0.pr4, 0::numeric) + COALESCE(table0.pr5, 0::numeric) + COALESCE(table0.pr6, 0::numeric) + COALESCE(table0.pr7, 0::numeric) + COALESCE(table0.pr8, 0::numeric) + COALESCE(table0.pr9, 0::numeric) + COALESCE(table0.pr10, 0::numeric) + COALESCE(table0.pr11, 0::numeric) + COALESCE(table0.pr12, 0::numeric) + COALESCE(table0.pr13, 0::numeric) + COALESCE(table0.pr14, 0::numeric) + COALESCE(table0.pr15, 0::numeric) + COALESCE(table0.pr16, 0::numeric) + COALESCE(table0.pr17, 0::numeric) + COALESCE(table0.pr18, 0::numeric))::double precision / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (table0.pr1), (table0.pr2), (table0.pr3), (table0.pr4), (table0.pr5), (table0.pr6), (table0.pr7), (table0.pr8), (table0.pr9), (table0.pr10), (table0.pr11), (table0.pr12), (table0.pr13), (table0.pr14), (table0.pr15), (table0.pr16), (table0.pr17), (table0.pr18)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM table0;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step5(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, op1 numeric, op2 numeric, op3 double precision, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;

    sql := 'WITH table0 AS (
         SELECT DISTINCT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.r1 * 0.76 AS r1,
            A.r2 * 0.76 AS r2
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step5('||parameters||') AS A
        ), table1 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text, '''||form_id||''')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.iso3,
            a.name,
            round(a.r1, 2) AS op1,
            round(a.r2, 2) AS op2,
            b.value_p AS op3
           FROM table0 a
             LEFT JOIN table1 b ON a.formid = b.formid
        )
 SELECT DISTINCT tableall.formid,
    tableall.wdpa_id,
    tableall.iso3,
    tableall.name,
    tableall.op1,
    tableall.op2,
    tableall.op3,
    round((((COALESCE(tableall.op1, 0::numeric) + COALESCE(tableall.op2, 0::numeric))::double precision + COALESCE(tableall.op3, 0::numeric::double precision)) / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (tableall.op1), (tableall.op2), (tableall.op3)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 2) AS avg_indicator
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step6(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 text, name text, oc1 numeric, oc2 numeric, oc3 numeric, avg_indicator numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';

BEGIN

    if form_id is not null then
        parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters:= parameters || ','''||c_iso3||'''';
    end if;


    sql := ' WITH table0 AS (
         SELECT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.ei1 * 0.76 AS oc1,
            round(((COALESCE(A.ei2::double precision, 0::numeric::double precision) + COALESCE(A.ei3)::double precision) / 2::double precision)::numeric, 2) AS oc2,
            A.ei4 AS oc3
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step6('||parameters||') AS A
        )
 SELECT DISTINCT table0.formid,
    table0.wdpa_id,
    table0.iso3,
    table0.name,
    table0.oc1,
    table0.oc2,
    table0.oc3,
    round(((COALESCE(table0.oc1, 0::numeric)::double precision + COALESCE(table0.oc2::double precision / 2::double precision + 50::double precision, 0::double precision) + COALESCE(table0.oc3::double precision / 2::double precision + 50::double precision, 0::double precision)) / NULLIF(( SELECT count(*) AS count
           FROM ( VALUES (table0.oc1), (table0.oc2), (table0.oc3)) v(col)
          WHERE v.col IS NOT NULL), 0)::double precision)::numeric, 1) AS avg_indicator
   FROM table0;';

    RETURN QUERY EXECUTE sql;

END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v1_to_v2.get_imet_evaluation_stats_step_by_formid_summary(
    form_id text DEFAULT NULL::text,
    c_iso3 text DEFAULT NULL::text)
    RETURNS TABLE(formid integer, wdpa_id integer, year integer, iso3 text, name text, context numeric, planning numeric, inputs numeric, process numeric, outputs numeric, outcomes numeric)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
declare
    sql text;
    parameters text DEFAULT 'NULL';
    form_parameters text DEFAULT 'NULL';
BEGIN

    if form_id is not null then
        parameters := ''''||form_id||''' ';
        form_parameters := ''''||form_id||'''';
    end if;

    if c_iso3 is not null then
        parameters := parameters || ',' || ''''||c_iso3||'''';
        form_parameters := form_parameters || ', '''||c_iso3||'''';
    end if;

    sql := ' WITH table0 AS (
	SELECT get_imet_forms.formid,
				get_imet_forms."Year" AS year,
				get_imet_forms.wdpa_id,
				get_imet_forms.iso3,
				get_imet_forms.name
	  FROM imet_assessment.get_imet_forms('||form_parameters||')
        ), table1 AS (
         SELECT get_imet_evaluation_stats_by_formid_step1.formid,
            get_imet_evaluation_stats_by_formid_step1.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step1('||parameters||')
        ), table2 AS (
         SELECT get_imet_evaluation_stats_by_formid_step2.formid,
            get_imet_evaluation_stats_by_formid_step2.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step2('||parameters||')
        ), table3 AS (
         SELECT get_imet_evaluation_stats_by_formid_step3.formid,
            get_imet_evaluation_stats_by_formid_step3.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step3('||parameters||')
        ), table4 AS (
         SELECT get_imet_evaluation_stats_by_formid_step4.formid,
            get_imet_evaluation_stats_by_formid_step4.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step4('||parameters||')
        ), table5 AS (
         SELECT get_imet_evaluation_stats_by_formid_step5.formid,
            get_imet_evaluation_stats_by_formid_step5.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step5('||parameters||')
        ), table6 AS (
         SELECT get_imet_evaluation_stats_by_formid_step6.formid,
            get_imet_evaluation_stats_by_formid_step6.avg_indicator
           FROM imet_assessment_v1_to_v2.get_imet_evaluation_stats_by_formid_step6('||parameters||')
        ), tableall AS (
         SELECT a.formid,
            a.wdpa_id,
            a.year,
            a.iso3,
            a.name,
            b.avg_indicator AS context,
            c.avg_indicator AS plans,
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
    tableall.plans,
    tableall.inputs,
    tableall.process,
    tableall.outputs,
    tableall.outcomes
   FROM tableall;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;



COMMIT;
