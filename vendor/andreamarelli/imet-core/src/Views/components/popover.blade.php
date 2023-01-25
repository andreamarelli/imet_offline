@once

    <style>
        .popover-header {
            font-size: 0.9em;
            font-style: italic;
            font-weight: bold;
            text-align: center;
        }

        .popover-body {
            display: flex;
            flex-direction: column;
        }

        .popover-body a {
            margin: 3px;
        }
    </style>

    <script>
        window.onload = function() {

            window.$('[data-toggle="tooltip"]').tooltip();

            window.$('[data-toggle="popover"]').popover({
                html: true,
                content: function () {
                    return document
                        .getElementById(this.getAttribute('data-popover-content'))
                        .querySelector(".popover-body").innerHTML;
                },
                title: function () {
                    return document
                        .getElementById(this.getAttribute('data-popover-content'))
                        .querySelector(".popover-heading").innerHTML;
                }
            });

        };
    </script>

@endonce
