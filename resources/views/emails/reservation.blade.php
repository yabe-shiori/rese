<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約確認メール</title>
</head>
<body>
    <h1>予約が確定しました</h1>
    <p>{{ $reservation->user->name }} 様、</p>
    <p>この度は、{{ $reservation->shop->name }} へのご予約ありがとうございます。</p>
    <p>以下の内容で予約が確定しましたので、ご確認ください。</p>
    <ul>
        <li>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</li>
        <li>店舗名: {{ $reservation->shop->name}}</li>
        <li>ユーザー名: {{ $reservation->user->name }}</li>
        <li>人数: {{ $reservation->number_of_people }}名</li>
    </ul>
    <p>来店時に、以下のQRコードをお店のスタッフにご提示ください。</p>
    <div>{!! $qrCode !!}</div>
    <p>予約に関する詳細やキャンセルは、マイページから行えます。</p>
</body>
</html>
