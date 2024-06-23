<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        multilingual();
        multicurrency();

        function multilingual() {
            let requiredValue = (getCookie("default_language") ? getCookie("default_language") : "en");
            // alert(requiredValue)
            $(".activated_chirag_language").text(requiredValue.toUpperCase());
            $('.all_chirag_language_list li').click(function() {
                let selectedValue = $(this).attr("data-value");
                setCookie("default_language", selectedValue, 365);
                let currentURL = window.location.href;
                window.location.href = currentURL.replace(getCookie("default_language"), selectedValue.toLowerCase());
            });
        }

        function multicurrency() {
            let requiredValue = (getCookie("default_currency") ? getCookie("default_currency") : "Indian Rupee|INR");
            // alert(requiredValue)
            let requiredText = requiredValue.split("|");
            let reqText = requiredText[0] + " (" + requiredText[1] + ")";
            $(".activated_chirag_currency").text(reqText);
            $('.all_chirag_currency_list li').click(function() {
                let selectedValue = $(this).attr("data-value");
                setCookie("default_currency", selectedValue, 365);
                let currentURL = window.location.href;
                let selectedValueCode = selectedValue.split("|")[1];
                window.location.href = currentURL.replace(requiredText[1], selectedValueCode);
            });
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
        }
    });
</script>