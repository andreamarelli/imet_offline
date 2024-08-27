<div class="ml-1" v-for="i in table_input_elems">
    <table_input v-model="report"
                 :report="report"
                 :id="'planning'"
                 :action="'edit'"
                 :group_key="i"
    ></table_input>
    <roadmap v-model="report"
             :report="report"
             :default_schema="{{ json_encode($report_schema) }}"
             :id="'roadmap'"
             :action="'edit'"
             :group_key="i"
    ></roadmap>
</div>
