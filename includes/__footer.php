
    <section class="footer bg-dark">
        <div class="container">
            <div class="top-footer">
                <div class="row">
                    <div class="col-lg-3 one">
                        <h4>Mobile Shopee</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis ipsam modi, deserunt distinctio illo aut?</p>
                    </div>
                    <div class="col-lg-3 two">
                        <form action="">
                            <label for="">Newsletters</label>
                            <div class="form-group d-flex">
                                <input type="email" class="form-control" placeholder="Email*......">
                                <button type="submit" class="ml-2 btn btn-primary">Subscrive</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 three">
                        <h4>Information</h4>
                        <ul>
                            <li>
                                <a href="#">About Us</a>
                            </li>
                            <li>
                                <a href="#">Delivery Information</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#">Terms & Conditionsa>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 four">
                        <h4>My Account</h4>
                        <ul>
                            <li>
                                <a href="#">Order History</a>
                            </li>
                            <li>
                                <a href="#">Wish List</a>
                            </li>
                            <li>
                                <a href="#">Newsletters</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="footer-bottom">
                <p>&copy;Copyrights 2021 Design by ConeCircle</p>
            </div>
        </div>
    </section>

    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery/owl.carousel.min.js"></script>
    <script src="index.js"></script>
    <script>
        let max = <?php echo $numOfComments ?? 0; ?>

        $(document).ready(function(){
            $(".set-bg").each(function(){
                let bg = $(this).data("setbg");

                $(this).css(
                    "background-image", "url(" + bg + ")"
                );
            });

            $(".banner").owlCarousel({
                loop: true,
                items: 1,
                autoplay: true,
                smartSpeed: 1200,
                nav: true,
                dots: true,
                navText: ["<i class='fa fa-angle-left'></>", "<i class='fa fa-angle-right'></>"]
            });

            $(".products").owlCarousel({
                loop: true,
                smartSpeed: 1200,
                nav: true,
                dots: false,
                autoplay: true,
                items: 4,
                margin: 20,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></>"]
            });

            $(".phones").owlCarousel({
                loop: true,
                autoplay: true,
                items: 4,
                smartSpeed: 1200,
                dots: false,
                nav: true,
                margin: 20,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></>"]
            });


            $("#commentBtn").click(function(){
                let $comment = $("#commentBox").val();

                if ($comment !== "") {
                    $.ajax({
                        url: "controller/comment.inc.php",
                        method: "POST",
                        data: {
                            addComment: 1,
                            comment: $comment
                        }, success: function(result) {
                            let response = JSON.parse(result);
                            max++;
                            $(".numComments").text(max + " Comments");
                            $(".comments").prepend(response);
                            $('#commentBox').val("");
                        }
                    })
                }else{
                    alert("Fill input fields!");
                }
            });


            getAllComments(0, max);
        });

        function getAllComments(start, max) {
            if (start > max) {
                return;
            }

            $.ajax({
                url: "controller/comment.inc.php",
                method: "POST",
                data: {
                    getComment: 1,
                    start: start
                }, success: function(result) {
                    let response = JSON.parse(result);
                    $(".comments").append(response);
                }
            });
        }

        var $qtyBtn = $(".qtyBtn");

        $qtyBtn.on("click", function(){
            var $incVal = $(this).parent().find(".qtyInput").val();
            var $incValId = $(this).parent().find(".qtyInput").data('id');
            var $price = $(`.item_price[data-id='${$incValId}']`).find(".price");
            var $price_value = $(`.item_price[data-id='${$incValId}']`).find(".price").text();
            
            if ($(this).hasClass("inc")) {
                if ($incVal >= 1 && $incVal < 9) {
                    var $newVal = parseFloat($incVal) + 1
                }else{
                    var $newVal = 9
                }
            }else{
                if ($(this).hasClass("dec")) {
                    if ($incVal > 1 && $incVal <= 9) {
                        var $newVal = parseFloat($incVal) - 1
                    }else{
                        var $newVal = 1
                    }
                }   
            }
            
            $(this).parent().find(".qtyInput").val($newVal);
            
            var $newQty = $(this).parent().find(".qtyInput").val();
            
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: {
                    itemId: $incValId
                }, success: function(result) {
                    let $obj = JSON.parse(result);
                    let $item_price = parseInt($obj[0]['item_price']);

                    $price.text(parseInt($newQty * $item_price).toFixed(2));
                    var $deal_price = $(".deal_price");
                    let allPrice = [...document.querySelectorAll(".price")];

                    var sum = 0;

                    for (let i = 0; i < allPrice.length; i++) {
                        sum += parseInt(allPrice[i].textContent);
                    }

                    $deal_price.text("$" + sum.toFixed(2));
                }
            });
        });
        </script>
</body>
</html>