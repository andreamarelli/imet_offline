BEGIN;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_p4(
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

    sql := 'SELECT
            eval_management_plan."FormID" AS formid,
            ''P4''::text AS section,
                (100.0 * ((eval_management_plan."PlanExistence"::integer
                     + coalesce(eval_management_plan."PlanUptoDate"::integer, 0)
                     + coalesce(eval_management_plan."PlanApproved"::integer, 0)
                     + coalesce(eval_management_plan."PlanImplemented"::integer, 0)
                )::numeric
                    + coalesce(eval_management_plan."VisionAdequacy", 0)
                    + coalesce( eval_management_plan."PlanAdequacyScore", 0)
                ) / (10.0 - nullif(
                       (coalesce(1 - (eval_management_plan."VisionAdequacy"/nullif(eval_management_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_management_plan."PlanAdequacyScore"/nullif(eval_management_plan."PlanAdequacyScore", 0)), 3)
                   ) ,0)))::double precision AS value_p
           FROM imet.eval_management_plan '||wherea||' ;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_p5(
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

    sql := 'SELECT
            eval_work_plan."FormID" AS formid,
            ''P4''::text AS section,
                (100.0 * ((eval_work_plan."PlanExistence"::integer
                     + coalesce(eval_work_plan."PlanUptoDate"::integer, 0)
                     + coalesce(eval_work_plan."PlanApproved"::integer, 0)
                     + coalesce(eval_work_plan."PlanImplemented"::integer, 0)
                )::numeric
                    + coalesce(eval_work_plan."VisionAdequacy", 0)
                    + coalesce( eval_work_plan."PlanAdequacyScore", 0)
                ) / (10.0 - nullif(
                       (coalesce(1 - (eval_work_plan."VisionAdequacy"/nullif(eval_work_plan."VisionAdequacy", 0)), 3)) +
                       (coalesce(1 - (eval_work_plan."PlanAdequacyScore"/nullif(eval_work_plan."PlanAdequacyScore", 0)), 3)
                   ) ,0)))::double precision AS value_p
           FROM imet.eval_work_plan '||wherea||' ;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_i4(
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

    sql := 'SELECT eval_budget_securization."FormID" AS formid,
           ''EVAL I4''::text AS section,
           ((eval_budget_securization."Percentage" / 5::numeric + eval_budget_securization."EvaluationScore" / 3::numeric) / 2::numeric * 100.0)::double precision AS value_p
            FROM imet.eval_budget_securization '||wherea||' ;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

CREATE OR REPLACE FUNCTION imet_assessment_v2.get_imet_evaluation_stats_cm_pr4(
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

    sql := 'SELECT eval_governance_leadership."FormID" AS formid,
           ''PR4''::text AS section,
           ((eval_governance_leadership."EvaluationScoreGovernace" + eval_governance_leadership."EvaluationScoreLeadership") / 6.0 * 100.0)::double precision AS value_p
    FROM imet.eval_governance_leadership '||wherea||' ;';

    RETURN QUERY EXECUTE sql;
END;
$BODY$;

COMMIT;