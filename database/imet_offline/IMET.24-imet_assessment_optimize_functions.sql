BEGIN;

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
    RETURNS TABLE(formid integer, "Year" integer, wdpa_id integer, iso3 character, name text)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, c1 numeric, c2 numeric, c3 numeric, c11 numeric, c12 numeric, c13 numeric, c14 numeric, c15 numeric, c16 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_cm_c2(''C2''::text, ''eval_supports_and_constaints''::text '||parameters||') get_imet_evaluation_stats_cm_c2(formid, section, value_p)
        ), table_c3 AS (
         SELECT get_imet_evaluation_stats_cm_c3.formid,
            get_imet_evaluation_stats_cm_c3.section,
            get_imet_evaluation_stats_cm_c3.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c3(''C3''::text, ''context_menaces_pressions''::text '||parameters||') get_imet_evaluation_stats_cm_c3(formid, section, value_p)
        ), table1 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.1''::text, ''eval_importance_c11''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_c12.formid,
            get_imet_evaluation_stats_cm_c12.section,
            get_imet_evaluation_stats_cm_c12.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c12(''C1.2''::text, ''eval_importance_c12''::text '||parameters||') get_imet_evaluation_stats_cm_c12(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_cm_c13.formid,
            get_imet_evaluation_stats_cm_c13.section,
            get_imet_evaluation_stats_cm_c13.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c13(''C1.3''::text, ''eval_importance_c13''::text '||parameters||') get_imet_evaluation_stats_cm_c13(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_cm_c14.formid,
            get_imet_evaluation_stats_cm_c14.section,
            get_imet_evaluation_stats_cm_c14.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_c14(''C1.4''::text, ''eval_importance_c14''::text '||parameters||') get_imet_evaluation_stats_cm_c14(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.5''::text, ''eval_importance_c15''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''C1.6''::text, ''eval_importance_c16''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, p1 numeric, p2 numeric, p3 numeric, p4 numeric, p5 numeric, p6 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P1''::text, ''eval_regulations_adequacy''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P2''::text, ''eval_design_adequacy''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_boundary_level''::text, ''EvaluationScore''::text, ''EVAL P3''::text '||parameters||') get_imet_evaluation_stats_rank_all(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P4''::text, ''eval_management_plan''::text, ''PlanExistenceScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P5''::text, ''eval_work_plan''::text, ''PlanExistenceScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''P6''::text, ''eval_objectives''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, i1 numeric, i2 numeric, i3 numeric, i4 numeric, i5 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''EVAL I1''::text, ''eval_information_availability''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_cm_i2.formid,
            get_imet_evaluation_stats_cm_i2.section,
            get_imet_evaluation_stats_cm_i2.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_i2(''EVAL I2''::text, ''eval_staff''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_cm_i2(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_budget_adequacy''::text, ''EvaluationScore''::text, ''EVAL I3''::text '||parameters||') get_imet_evaluation_stats_rank_all(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_budget_securization''::text, ''EvaluationScore''::text, ''EVAL I4''::text '||parameters||') get_imet_evaluation_stats_rank_all(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_cm_i5.formid,
            get_imet_evaluation_stats_cm_i5.section,
            get_imet_evaluation_stats_cm_i5.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_i5(''EVAL I5''::text, ''eval_management_equipment_adequacy''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_cm_i5(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric, pr7 numeric, pr8 numeric, pr9 numeric, pr10 numeric, pr11 numeric, pr12 numeric, pr13 numeric, pr14 numeric, pr15 numeric, pr16 numeric, pr17 numeric, pr18 numeric, pr19 numeric, pr1_6 numeric, pr7_10 numeric, pr11_13 numeric, pr14_15 numeric, pr16_17 numeric, pr18_19 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr1(''PR1''::text, ''eval_staff_competence''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_cm_pr1(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR2''::text, ''eval_hr_management_politics''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR3''::text, ''eval_hr_management_systems''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR4''::text, ''eval_governance_leadership''::text, ''EvaluationScoreGovernace''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR5''::text, ''eval_administrative_management''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR6''::text, ''eval_equipment_maintenance''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table7 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR7''::text, ''eval_management_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table8 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR8''::text, ''eval_protection_activities''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table9 AS (
         SELECT get_imet_evaluation_stats_rank_all.formid,
            get_imet_evaluation_stats_rank_all.section,
            get_imet_evaluation_stats_rank_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text '||parameters||') get_imet_evaluation_stats_rank_all(formid, section, value_p)
        ), table10 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR10''::text, ''eval_law_enforcement''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table11 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR11''::text, ''eval_implications''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table12 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR12''::text, ''eval_assistance_activities''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table13 AS (
         SELECT get_imet_evaluation_stats_cm_pr13.formid,
            get_imet_evaluation_stats_cm_pr13.section,
            get_imet_evaluation_stats_cm_pr13.value_p
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr13(''PR13''::text, ''eval_actors_relations''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_cm_pr13(formid, section, value_p)
        ), table14 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR14''::text, ''eval_visitors_management''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table15 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR15''::text, ''eval_visitors_impact''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table16 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR16''::text, ''eval_natural_resources_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table17 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR17''::text, ''eval_research_and_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table18 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR18''::text, ''eval_climate_change_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table19 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR19''::text, ''eval_ecosystem_services''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, r1 numeric, r2 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''R1''::text, ''eval_work_program_implementation''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''R2''::text, ''eval_achieved_results''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, ei1 numeric, ei2 numeric, ei3 numeric, ei4 numeric, ei5 numeric, ei6 numeric, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I1''::text, ''eval_achived_objectives''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table2 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''E/I2''::text, ''eval_designated_values_conservation''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table3 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''E/I3''::text, ''eval_designated_values_conservation_tendency''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table4 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I4''::text, ''eval_local_communities_impact''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table5 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I5''::text, ''eval_climate_change_impact''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table6 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''E/I6''::text, ''eval_ecosystem_services_impact''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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

COMMIT;
