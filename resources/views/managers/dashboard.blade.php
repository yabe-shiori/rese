<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- コンテンツ部分 -->
        <div class="py-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-2xl font-semibold mb-6">店舗代表者用ダッシュボード</h1>

                <!-- タブやメニューなど、必要に応じて管理画面の構成要素を追加 -->

                <!-- 店舗情報新規作成へのリンク -->
                <a href="{{ route('managers.create') }}" class="text-blue-500 hover:underline mb-4 inline-block">新しい店舗情報を作成</a>

                <!-- 店舗情報一覧表示 -->
                {{-- <a href="{{ route('managers.edit') }}" class="text-blue-500 hover:underline mb-4 inline-block">店舗情報編集</a> --}}

                <!-- 予約情報確認リンク -->
                <a href="{{ route('managers.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">予約情報確認</a>

                <!-- ここに店舗代表者向けの情報や機能を追加 -->

            </div>
        </div>
    </div>
</x-app-layout>
