export default {

    methods:{

        /**
         * Manage bar show/hide transitions
         */
        beforeShowBar: function (el) {
            $(el).css("display", 'none');
        },
        showBar: function (el, done) {
            $(el).slideDown(400, function () {
                $(this).css("display", 'block');
                done();
            });
        },
        hideBar: function (el, done) {
            $(el).slideUp(400, function () {
                $(this).css("display", 'none');
                done();
            });
        },

    }
}