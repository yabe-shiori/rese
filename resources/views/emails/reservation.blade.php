<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約確認メール</title>
</head>
<body>
    <h1>予約が確定しました</h1>
    <p>以下の内容で予約が確定しました。</p>
    <ul>
        <li>予約ID: {{ $reservation->id }}</li>
        <li>店舗名: {{ $reservation->shop->name}}</li>
        <li>ユーザー名: {{ $reservation->user->name }}</li>
        <li>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</li>
    </ul>
    <p>来店時に、以下のQRコードをお店のスタッフにご提示ください。</p>
    <div>{!! $qrCode !!}</div>
</body>
</html>
