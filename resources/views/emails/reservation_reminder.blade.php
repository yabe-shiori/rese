<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Reservation Reminder</title>
</head>

<body>
    <h1>本日のご来店についてのご案内</h1>
    <p>こんにちは、{{ $reservation->user->name }} さん。</p>
    <p>{{ $reservation->shop->name }} へのご予約をいただき、誠にありがとうございます。本日はご来店予定日ですので、予約の詳細をお知らせいたします。</p>
    <ul>
        <li>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</li>
        <li>店舗名: {{ $reservation->shop->name }}</li>
        <li>人数: {{ $reservation->number_of_people }}名</li>
    </ul>
    <p>何か質問や変更があれば、お気軽にご連絡ください。{{ $reservation->shop->name }}のスタッフ一同、心よりお待ちしております。</p>
    <p>素敵な時間をお過ごしください！</p>
</body>

</html>
