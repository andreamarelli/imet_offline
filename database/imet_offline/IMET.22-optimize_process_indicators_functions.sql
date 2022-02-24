BEGIN;

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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr1_pr6
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr7_pr9
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
           FROM imet_assessment_v2.v_imet_forms
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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr10_pr12
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
           FROM imet_assessment_v2.v_imet_forms
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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr13_pr14
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
           FROM imet_assessment_v2.v_imet_forms
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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr15_pr16
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
           FROM imet_assessment_v2.v_imet_forms
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


CREATE VIEW imet_assessment_v2.v_imet_eval_stat_process_pr17_pr18
 AS
 WITH table0 AS (
         SELECT v_imet_forms."FormID" AS formid
           FROM imet_assessment_v2.v_imet_forms
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

COMMIT;
