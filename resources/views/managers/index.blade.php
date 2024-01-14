<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <h1>予約情報一覧</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>予約日</th>
                <th>予約時間</th>
                <th>ユーザー名</th>
                <th>人数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</x-app-layout>
