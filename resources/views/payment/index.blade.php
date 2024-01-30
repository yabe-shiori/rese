<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div
            class="bg-white p-8 rounded-md shadow-md text-center md:w-4/12 w-full flex flex-col items-center justify-center">
            <h1 class="text-xl mb-6 tracking-widest font-bold">支払い情報</h1>

            <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
            <p>人数: {{ $reservation->number_of_people }}名</p>

            <h2 class="text-lg font-bold mt-4">メニュー</h2>
            <form id="paymentForm" action="{{ route('payment.store') }}" method="post">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                @foreach ($menu as $dish)
                    <div class="mb-2 flex items-center justify-between">
                        <span class="dish-name">{{ $dish->name }}:</span>
                        <span class="dish-price"
                            data-price="{{ $dish->price }}">¥{{ number_format($dish->price) }}</span>
                        <input type="number" class="quantity w-16 ml-4" id="quantity_{{ $dish->id }}"
                            name="quantity[{{ $dish->id }}]" value="0" min="0" onchange="updateTotal()">
                    </div>
                @endforeach
                <div id="card-element">
                    <!-- Stripeのカード情報入力フォーム -->
                </div>

                <p id="totalAmount" class="text-lg font-bold my-4">合計金額: ¥0</p>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">支払う</button>
            </form>

            <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mt-4 inline-block">戻る</a>
        </div>
    </div>

    <script>
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.quantity').forEach(input => {
                const dishPrice = input.closest('.flex').querySelector('.dish-price').dataset.price;
                total += parseInt(input.value) * parseInt(dishPrice);
            });
            document.getElementById('totalAmount').textContent = `合計金額: ¥${total.toLocaleString()}`;
        }

        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', updateTotal);
        });

        window.onload = updateTotal;
    </script>
    <script>
        var stripe = Stripe(
            'pk_test_51OYLVZCkOf5udESXKFogt6xbIgqkok1YV7TVZ67eVMuv0ZgWdMmZmUCD4KgM0Et7dkJuXXZ4IBKeRbSmu8m9AgiQ00V2LY8yxz'
        );

        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        var form = document.getElementById('paymentForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {

                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {

                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);

                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>
