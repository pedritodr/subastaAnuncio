<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <form id="kushki-pay-form" action="confirm" method="post">
                <input type="hidden" name="cart_id" value="123">
            </form>

        </div>
    </div>
</div>
<script src="https://cdn.kushkipagos.com/kushki-checkout.js"></script>
<script type="text/javascript">
    var kushki = new KushkiCheckout({
        form: "kushki-pay-form",
        merchant_id: "7c19d3df51644f5c9e37b5433931d685",
        amount: {
            "subtotalIva": 0, // Set it to 0 in case the transaction has no taxes
            "iva": 0, // Set it to 0 in case the transaction has no taxes
            "subtotalIva0": 10000, // Set the total amount of the transaction here in case the it has no taxes. Otherwise, set it to 0
            "ice": 0 // Set it to 0 in case the transaction has no ICE (Impuesto a consumos especiales)
        },
        currency: "COP",
        payment_methods: ["transfer"], // Payment Methods enabled
        inTestEnvironment: true,
        callback_url: "https://t72ajthpqukj.runscope.net" // Not required for Mexico
    });
</script>