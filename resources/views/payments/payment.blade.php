<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Frames v2</title>
  <style>*,*::after,*::before{box-sizing:border-box}html{padding:1rem;background-color:#FFF;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif}#payment-form{width:31.5rem;margin:0 auto}iframe{width:100%}.one-liner{display:flex;flex-direction:column}#pay-button{border:none;border-radius:3px;color:#FFF;font-weight:500;height:40px;width:100%;background-color:#13395E;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:active{background-color:#0B2A49;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:hover{background-color:#15406B;box-shadow:0 2px 5px 0 rgba(19,57,94,0.4)}#pay-button:disabled{background-color:#697887;box-shadow:none}#pay-button:not(:disabled){cursor:pointer}.card-frame{border:solid 1px #13395E;border-radius:3px;width:100%;margin-bottom:8px;height:40px;box-shadow:0 1px 3px 0 rgba(19,57,94,0.2)}.card-frame.frame--rendered{opacity:1}.card-frame.frame--rendered.frame--focus{border:solid 1px #13395E;box-shadow:0 2px 5px 0 rgba(19,57,94,0.15)}.card-frame.frame--rendered.frame--invalid{border:solid 1px #D96830;box-shadow:0 2px 5px 0 rgba(217,104,48,0.15)}.success-payment-message{color:#13395E;line-height:1.4}.token{color:#b35e14;font-size:0.9rem;font-family:monospace}@media screen and (min-width: 31rem){.one-liner{flex-direction:row}.card-frame{width:318px;margin-bottom:0}#pay-button{width:175px;margin-left:8px}}</style>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<body>

  <!-- add frames script -->
  <script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
<div class="msg"></div>
  <form id="payment-form" method="POST" action="https://merchant.com/charge-card">
    <div class="one-liner">
      <div class="card-frame">
        <!-- form will be added here -->
      </div>
      <!-- add submit button -->
      <button id="pay-button" disabled>
        PAY USD {{ $amount }}
      </button>
    </div>
    <p class="success-payment-message"></p>
  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    var payButton = document.getElementById("pay-button");
    var form = document.getElementById("payment-form");

    Frames.init('{{ env("PK_CHECKOUT") }}');

    Frames.addEventHandler(
      Frames.Events.CARD_VALIDATION_CHANGED,
      function (event) {
        console.log("CARD_VALIDATION_CHANGED: %o", event);

        payButton.disabled = !Frames.isCardValid();
      }
    );

    Frames.addEventHandler(
      Frames.Events.CARD_TOKENIZED,
      function (event) {
        var el = document.querySelector(".success-payment-message");
        el.innerHTML = "Card tokenization completed<br>" +
          "Your card token is: <span class=\"token\">" + event.token + "</span>";


        //   Send Token to the server
        // $.ajax({
        //     type: 'post'
        // })
        $.post({
            url: '{{ route("payment") }}',
            data: {
                _token: '{{ csrf_token() }}',
                token: event.token,
                amount: '{{ $amount }}'
            },
            success: function(res) {
                let alert = `<div class="alert alert-${res.type}">${res.msg}</div>`;
                $('#payment-form').remove();
                $('.msg').html(alert)
            }
        })




      }
    );

    form.addEventListener("submit", function (event) {
 	  payButton.disabled = true // disables pay button once submitted
      event.preventDefault();
      Frames.submitCard();
    });
  </script>

</body>

</html>
