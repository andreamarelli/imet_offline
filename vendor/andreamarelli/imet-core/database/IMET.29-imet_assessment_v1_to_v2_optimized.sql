
BEGIN;

DROP SCHEMA IF EXISTS imet_assessment_v1_to_v2 CASCADE;
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, c1 numeric, c2 numeric, c3 numeric, c11 numeric, c12 numeric, c13 numeric, c14 numeric, c15 numeric, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, p1 numeric, p2 numeric, p3 numeric, p4 numeric, p5 numeric, p6 numeric, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, i1 numeric, i2 numeric, i3 numeric, i4 numeric, i5 numeric, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, pr1 numeric, pr2 numeric, pr3 numeric, pr4 numeric, pr5 numeric, pr6 numeric, pr7 numeric, pr8 numeric, pr9 numeric, pr10 numeric, pr11 numeric, pr12 numeric, pr13 numeric, pr14 numeric, pr15 numeric, pr16 numeric, pr17 numeric, pr18 numeric, pr1_6 numeric, pr7_10 numeric, pr11_13 numeric, pr14_15 numeric, pr16_17 numeric, pr18_19 integer, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, op1 numeric, op2 numeric, op3 double precision, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, oc1 numeric, oc2 numeric, oc3 numeric, avg_indicator numeric)
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
    RETURNS TABLE(formid integer, wdpa_id integer, year integer, iso3 character, name text, context numeric, planning numeric, inputs numeric, process numeric, outputs numeric, outcomes numeric)
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
