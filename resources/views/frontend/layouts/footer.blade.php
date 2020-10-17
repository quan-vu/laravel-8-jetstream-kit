<div class="footer-content py-lg-5 py-4 text-center">
    <div class="container">
        <div class="copy-right">
            <h6>© 2020 Design Blog . Made with <span class="fa fa-heart" aria-hidden="true"></span>, Theme credit
                <a href="https://w3layouts.com">W3layouts</a> </h6>
        </div>
        <ul class="author-icons mt-4">
            <li><a class="facebook" href="#url"><span class="fa fa-facebook" aria-hidden="true"></span></a>
            </li>
            <li><a class="twitter" href="#url"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
            <li><a class="google" href="#url"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
            </li>
            <li><a class="linkedin" href="#url"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>
            <li><a class="github" href="#url"><span class="fa fa-github" aria-hidden="true"></span></a></li>
            <li><a class="dribbble" href="#url"><span class="fa fa-dribbble" aria-hidden="true"></span></a></li>
        </ul>
        <button onclick="topFunction()" id="movetop" title="Go to top">
            <span class="fa fa-angle-up"></span>
        </button>
    </div>
</div>

<!-- move top -->
<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
        } else {
            document.getElementById("movetop").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
<!-- //move top -->