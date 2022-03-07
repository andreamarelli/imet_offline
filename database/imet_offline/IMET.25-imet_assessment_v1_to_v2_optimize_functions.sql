BEGIN;

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
           FROM imet_assessment.get_imet_evaluation_stats_cm_pr13(''PR13''::text, ''eval_actors_relations''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_cm_pr13(formid, section, value_p)
        ), table14 AS (
         SELECT get_imet_evaluation_stats_group_all.formid,
            get_imet_evaluation_stats_group_all.section,
            get_imet_evaluation_stats_group_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR14''::text, ''eval_visitors_management''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
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
           FROM imet_assessment.get_imet_evaluation_stats_group_all(''PR15''::text, ''eval_visitors_impact''::text, ''EvaluationScore''::text, ''group_key''::text '||parameters||') get_imet_evaluation_stats_group_all(formid, section, value_p)
        ), table16 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR16''::text, ''eval_natural_resources_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR17''::text, ''eval_research_and_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
        ), table18 AS (
         SELECT get_imet_evaluation_stats_table_all.formid,
            get_imet_evaluation_stats_table_all.section,
            get_imet_evaluation_stats_table_all.value_p
           FROM imet_assessment.get_imet_evaluation_stats_table_all(''PR18''::text, ''eval_climate_change_monitoring''::text, ''EvaluationScore''::text '||parameters||') get_imet_evaluation_stats_table_all(formid, section, value_p)
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
    raise notice 'sql: %',sql;
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, r1 numeric, r2 numeric, r3 double precision, avg_indicator numeric)
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
           FROM imet_assessment.get_imet_evaluation_stats_rank_all(''eval_control''::text, ''EvaluationScore''::text, ''EVAL PR9''::text, '''||form_id||''') get_imet_evaluation_stats_rank_all(formid, section, value_p)
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
    RETURNS TABLE(formid integer, wdpa_id integer, iso3 character, name text, ei1 numeric, ei2 numeric, ei3 numeric, avg_indicator numeric)
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
        parameters := ''''||form_id||''' ';
    end if;

    sql := ' WITH table0 AS (
         SELECT A.formid,
            A.wdpa_id,
            A.iso3,
            A.name,
            A.ei1 * 0.76 AS ei1,
            round(((COALESCE(A.ei2::double precision, 0::numeric::double precision) + COALESCE(A.ei3)::double precision) / 2::double precision)::numeric, 2) AS ei2,
            A.ei4 AS ei3
           FROM imet_assessment.get_imet_evaluation_stats_by_formid_step6('||parameters||') AS A
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
