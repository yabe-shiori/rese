<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //仙人
        DB::table('dishes')->insert([
            'shop_id' => 1,
            'name' => '特上寿司プレミアムコース',
            'description' => '当店自慢の特上ネタをふんだんに使用した、プレミアムなお寿司コースです。新鮮な海の幸を心ゆくまでご堪能いただけます。',
            'price' => 9800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 1,
            'name' => '旬の刺身と握り寿司セット',
            'description' => '旬の刺身と握り寿司が楽しめる贅沢なセット。シェフが厳選したネタで、季節の味覚をお楽しみいただけます。',
            'price' => 3800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 1,
            'name' => 'ベジタリアン寿司プレート',
            'description' => '野菜寿司や季節の野菜を使用したヘルシーな寿司プレート。ベジタリアンの方や野菜好きな方におすすめです。',
            'price' => 2200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //牛助
        DB::table('dishes')->insert([
            'shop_id' => 2,
            'name' => '特選焼肉プレミアムセット',
            'description' => '厳選されたA5ランク黒毛和牛の焼肉プレミアムセット。贅沢な肉の旨味を余すことなくお楽しみいただけます。コクと香りが広がる至福のひととき。',
            'price' => 7800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 2,
            'name' => '和牛と海鮮の焼肉スペシャルセット',
            'description' => 'こだわりの和牛と新鮮な海の幸、両方楽しめる贅沢なスペシャルセット。焼肉と海鮮のハーモニーが舌を魅了します。',
            'price' => 5500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 2,
            'name' => '野菜と豚肉のヘルシーグリルセット',
            'description' => '旬の野菜とジューシーな豚肉が楽しめるヘルシーグリルセット。焼きたての野菜と豚肉で心も体も満たされます。',
            'price' => 3200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //戦慄
        DB::table('dishes')->insert([
            'shop_id' => 3,
            'name' => '大衆居酒屋の名物鍋セット',
            'description' => '大衆居酒屋の名物、鳥かわ煮込み串を中心とした鍋セット。具だくさんの煮込み串が食欲をそそります。心温まる味わいをお楽しみください。',
            'price' => 3800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 3,
            'name' => '極上串焼きセット',
            'description' => 'こだわりの比内地鶏を使用した極上串焼きセット。炭火でじっくり焼き上げた串は香ばしく、素材の旨味が引き立ちます。お酒との相性抜群です。',
            'price' => 4200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 3,
            'name' => 'オリジナル激辛おでんプレート',
            'description' => '当店自慢の激辛おでんプレート。シビレる辛さと旨味がクセになります。一品料理として、またお酒のアテにも最適です。',
            'price' => 2500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //ルーク
        DB::table('dishes')->insert([
            'shop_id' => 4,
            'name' => 'ルークのトスカーナ風ディナーコース',
            'description' => 'トスカーナ地方の伝統的なフレーバーが楽しめるディナーコース。新鮮なオリーブオイル、トマト、香草を使用したアンティパストから始まり、ワインと共にお楽しみください。',
            'price' => 5200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 4,
            'name' => '海と大地の調和 ルーク特製シーフードパレット',
            'description' => '海の幸と大地の恵みが織り成す特製シーフードパレット。シェフ厳選の新鮮な魚介と地元産の野菜を使用した贅沢な一皿です。',
            'price' => 4800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 4,
            'name' => 'ルークのシェフが選ぶ旬の香りディナーセット',
            'description' => 'シェフがその日の市場で見つけた旬の食材を使用した特別なディナーセット。その日一番の新鮮さと香りをお楽しみいただけます。',
            'price' => 5500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //志摩屋
        DB::table('dishes')->insert([
            'shop_id' => 5,
            'name' => 'ラーメン職人のスペシャルコース',
            'description' => 'ラーメン職人が厳選した極上の麺とスープを使用した特別なラーメンコース。限定数の提供となります。予約時に事前にお支払いいただくことで、確実にご提供いたします。',
            'price' => 2500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //香
        DB::table('dishes')->insert([
            'shop_id' => 6,
            'name' => '香楽セット',
            'description' => '当店自慢の厳選された特上肉を使用した極上の焼肉セット。各部位の旨味を存分に味わえるプレミアムなコースです。香り高い焼肉をお楽しみください。',
            'price' => 4500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 6,
            'name' => '贅沢和牛コース',
            'description' => 'こだわり抜いた和牛を贅沢に使用した焼肉コース。極上の霜降り肉から選りすぐりの部位を揃え、上質な味わいをお届けします。贅沢なひとときをお楽しみください。',
            'price' => 6800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 6,
            'name' => '香の特製ベジセット',
            'description' => '野菜愛が詰まった特製の焼肉ベジセット。新鮮な旬の野菜を贅沢に使用し、焼肉の美味しさをヘルシーに楽しめるコースです。肉好きでない方もご満足いただけます。',
            'price' => 3200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //JJ
        DB::table('dishes')->insert([
            'shop_id' => 7,
            'name' => 'ジャストジャケットセット',
            'description' => 'おしゃれな雰囲気の中で楽しむ、ジャストサイズのイタリアンセット。前菜からデザートまで、シェフが厳選した料理をお楽しみいただけます。おしゃれなディナータイムをお過ごしください。',
            'price' => 5500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 7,
            'name' => 'JJの特製トリュフコース',
            'description' => '新鮮なトリュフを贅沢に使用した特別な一皿。トリュフの香りと風味が広がる料理が勢揃いのコースです。贅沢な味わいをお楽しみください。',
            'price' => 7800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 7,
            'name' => 'ミラノハーモニーセット',
            'description' => 'ミラノからインスパイアされたハーモニーあるイタリアンセット。ワインとのペアリングが楽しめる料理が揃ったコースです。美味しい料理と共に心地よいひとときをお過ごしください。',
            'price' => 6500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //ラーメン極み
        DB::table('dishes')->insert([
            'shop_id' => 8,
            'name' => '極み特製ラーメンセット',
            'description' => '数量限定！当店自慢の濃厚な鶏白湯スープと自家製の極太麺が特徴の特製ラーメン。トッピングには新鮮なチャーシューと味玉がたっぷり。ラーメン愛好者にはたまらない逸品です。',
            'price' => 1200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //鳥雨
        DB::table('dishes')->insert([
            'shop_id' => 9,
            'name' => '夢の鳥雨コース',
            'description' => 'お店自慢の唐揚げのほか、季節の新鮮な鳥料理を盛り込んだ至福の鳥雨コース。特製の鳥レバーのパテと自家製ソースが絶妙なハーモニーを奏でます。',
            'price' => 4500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 9,
            'name' => '和風鳥雨プレミアムセット',
            'description' => '日本の風情漂うセット。季節の山菜と焼き鳥のコンビネーションに舌鼓。仕事帰りのリラックスタイムにぴったりのプレミアムな一皿。',
            'price' => 5800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 9,
            'name' => '鳥雨の夜明けスペシャル',
            'description' => '贅沢な夜を演出する特別なセット。和牛と鳥の贅沢なコラボレーションで、幻想的な雰囲気の中、至福のひとときをお楽しみください。',
            'price' => 6800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //築地色合
        DB::table('dishes')->insert([
            'shop_id' => 10,
            'name' => '贅沢寿司舞台裏セット',
            'description' => '築地から直送される極上のネタを使用した、シェフ特製の贅沢な寿司セット。まるで寿司職人の舞台裏にいるかのような特別感をお楽しみください。',
            'price' => 5000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 10,
            'name' => '季節の彩り折り寿司',
            'description' => '季節ごとに変わる旬のネタを使用した、彩り豊かな折り寿司セット。目でも楽しめる美しい盛り付けと共に、新鮮な味わいをお楽しみいただけます。',
            'price' => 3800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 10,
            'name' => '築地海鮮漬け丼セット',
            'description' => '築地直送の海鮮をふんだんに使った海鮮漬け丼セット。新鮮な刺身の旨味がご飯と一緒に広がり、海の幸をたっぷり味わえる一品です。',
            'price' => 2800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //晴海
        DB::table('dishes')->insert([
            'shop_id' => 11,
            'name' => '贅沢和牛炙り焼きセット',
            'description' => '当店自慢のA5ランクの和牛を、特製の炙り焼きでお楽しみいただく贅沢セット。肉の旨味と香ばしさが絶妙に調和し、至福のひとときをご堪能ください。',
            'price' => 8800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 11,
            'name' => '季節野菜と共に楽しむ焼肉デライト',
            'description' => '当旬の野菜とともに楽しむ、焼肉デライトセット。新鮮な季節野菜と上質なお肉の組み合わせが、バラエティ豊かな味わいをお届けします。',
            'price' => 4200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 11,
            'name' => 'ジューシー韓国風ネギ塩カルビセット',
            'description' => 'ジューシーで風味豊かな韓国風ネギ塩カルビをメインに、お好みの野菜と共に楽しむセット。爽やかなネギとお肉の相性が抜群です。',
            'price' => 3200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 三子
        DB::table('dishes')->insert([
            'shop_id' => 12,
            'name' => 'プレミアム肉三昧セット',
            'description' => '当店自慢のプレミアム肉を心ゆくまで楽しむことができるセット。最高級の肉質と独自の調理法で仕上げた特製のたれと相まって、至福の焼肉体験をお届けします。',
            'price' => 7800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 12,
            'name' => '和牛贅沢コース',
            'description' => 'こだわり抜いたA5ランクの和牛を使用した、至高の焼肉コース。新鮮で上質な肉の旨味をご堪能いただけるとともに、各種サイドメニューとの相性も抜群です。',
            'price' => 9500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 12,
            'name' => '焼肉三子名物！ユッケパーティーセット',
            'description' => 'オリジナルのユッケソースでいただく、自慢のユッケを贅沢に使用したセット。さっぱりとした味わいとヘルシーな一品で、おしゃれな焼肉パーティーを演出します。',
            'price' => 5000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //八戒
        DB::table('dishes')->insert([
            'shop_id' => 13,
            'name' => '八戒の極上食べ放題プラン',
            'description' => '当店自慢の焼き鳥や季節のおつまみ、サラダ、揚げ物など、多彩なメニューが食べ放題。2時間の制限内で、八戒の味を心行くまでお楽しみください。',
            'price' => 4800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 13,
            'name' => '贅沢海鮮食べ放題コース',
            'description' => '新鮮な海の幸が存分に楽しめる海鮮食べ放題。八戒厳選の刺身や寿司、海鮮料理が、お好きなだけお召し上がりいただけます。',
            'price' => 5500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 13,
            'name' => 'ビールと相性抜群！八戒の唐揚げセット',
            'description' => 'サクサクの衣とジューシーな鶏肉が絶妙なバランスの唐揚げ。ビールとの相性抜群で、気軽な一杯と共に楽しむことができる八戒の定番セット。',
            'price' => 2800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //福助
        DB::table('dishes')->insert([
            'shop_id' => 14,
            'name' => '福助の至極寿司プレミアムコース',
            'description' => 'ミシュラン掲載店で腕を磨いた寿司職人が、特別なひとときをお約束する至極の寿司プレミアムコース。こだわりの食材と繊細な技術が調和し、贅沢な味わいをお楽しみいただけます。',
            'price' => 12000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 14,
            'name' => '福助の季節の鮮魚寿司セット',
            'description' => 'ミシュラン掲載店で腕を磨いた職人が厳選した、季節の旬な魚介を使用した寿司セット。その日一番の新鮮なネタで彩り豊かな寿司をお楽しみください。',
            'price' => 6800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 14,
            'name' => '福助の特製押し寿司プレート',
            'description' => 'ミシュラン掲載店で培った技術が息づく、特製の押し寿司プレート。職人の手によって丁寧に仕上げられた美しい寿司が、味覚と視覚の両方で楽しませてくれます。リーズナブルでありながら福助の真髄を味わえる一品です。',
            'price' => 4500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //ラー北
        DB::table('dishes')->insert([
            'shop_id' => 15,
            'name' => '北極ラーメンプレミアムセット',
            'description' => 'ラー北自慢の極太麺とコク深いスープが贅沢に楽しめる北極ラーメン。特製のトッピングとともに、至福のラーメン体験をお届けします。予約時に事前決済可能なプレミアムセットです。',
            'price' => 2500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //翔
        DB::table('dishes')->insert([
            'shop_id' => 16,
            'name' => '翔の博多名物コース',
            'description' => '博多出身の店主が心を込めて提供する、本場博多の味覚を凝縮した名物コース。博多とんこつラーメンの元祖として知られるスープをベースに、博多のご当地グルメが堪能できる一皿です。',
            'price' => 3500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 16,
            'name' => '翔の魚介鍋プレミアムセット',
            'description' => ' 博多の新鮮な海の幸をたっぷりと使用した、贅沢な魚介鍋プレミアムセット。旬の素材を活かした心温まる鍋料理で、寒い季節にぴったりのコースです。',
            'price' => 4800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 16,
            'name' => '翔の博多串焼きディナーコース',
            'description' => ' 博多風の串焼きが楽しめるディナーコース。店主自ら選りすぐった厳選素材を使用し、備長炭で豪快に焼き上げます。焼きたてアツアツの串焼きが、食欲をそそる逸品となっています。',
            'price' => 3200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //経緯
        DB::table('dishes')->insert([
            'shop_id' => 17,
            'name' => '経緯の江戸前鮨特選プレミアムコース',
            'description' => '当店自慢の江戸前鮨を堪能できる、特選プレミアムコース。新鮮なネタと職人の技が交わり、口の中で広がる至福の味わい。海鮮太巻きや当店自慢の蒸し鮑も贅沢に盛り込んだ、贅沢なひと時をお楽しみください。',
            'price' => 9800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 17,
            'name' => '経緯の海鮮太巻き祭りセット',
            'description' => '海の幸が豊富な経緯のお寿司を、海鮮太巻き祭りセットで存分に楽しむ。新鮮なネタが彩る太巻き寿司が揃い、口に広がる幸福感を感じることができます。',
            'price' => 4200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 17,
            'name' => '経緯の鮑と共に愉しむ贅沢ディナーコース',
            'description' => '当店自慢の蒸し鮑と共に、経緯が厳選した魚介類や江戸前鮨を楽しむディナーコース。上質なお酒とともに、贅沢で幻想的なひとときをお過ごしいただけます。',
            'price' => 7800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //漆
        DB::table('dishes')->insert([
            'shop_id' => 18,
            'name' => '漆の至極焼肉プレミアムコース',
            'description' => '漆の自慢、至極の焼き肉を楽しむプレミアムコース。希少部位や上質な国産牛を厳選し、炭火で焼き上げます。極上の肉質と濃厚な味わいが贅沢なディナータイムを演出します。',
            'price' => 12000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 18,
            'name' => '漆の肉質選べる至福コース',
            'description' => 'こだわりの焼肉を存分に楽しむ至福コース。お好みの肉質を選べる特典付きで、各部位の旨味と食感を満喫。炭火焼きの香りとともに、極上の焼肉がお楽しみいただけます。',
            'price' => 8500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 18,
            'name' => '漆の贅沢焼肉ディナーセット',
            'description' => '贅を尽くした焼肉ディナーセット。比内地鶏や特選和牛を使用し、職人が心を込めて焼き上げます。清潔な店内と共に、至極の焼き肉をご賞味ください。',
            'price' => 9800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //THE TOOL
        DB::table('dishes')->insert([
            'shop_id' => 19,
            'name' => 'THE TOOLの至福ディナーコース',
            'description' => '特別な日にぴったりなディナーコース。シェフの技が光るシグネチャーディッシュや、ワインとのマリアージュが楽しめる一皿一皿。洗練された空間で、大切な人との特別なひと時を演出します。',
            'price' => 15000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 19,
            'name' => 'THE TOOLの大人の贅沢ランチセット',
            'description' => '大人のランチタイムを優雅に演出するエレガントなセット。季節感あふれる彩り鮮やかな料理と、上質なワインの組み合わせが楽しめます。カジュアルながらも上品なランチのひととき。',
            'price' => 15000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 19,
            'name' => 'THE TOOLのディナーディライト',
            'description' => '大人がくつろぐ非日常的なディナータイム。シェフが心を込めて仕上げた料理は、シンプルながらも深い味わい。上質な音楽と共に、落ち着いた雰囲気で至福のディナータイムをお楽しみいただけます。',
            'price' => 15000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //木船
        DB::table('dishes')->insert([
            'shop_id' => 20,
            'name' => '木船の旬の魚彩り寿司プレミアムセット',
            'description' => '日々新鮮な魚介類を厳選し、店主が心を込めて握る寿司のセット。季節ごとに変わる美しい盛り付けと、豊富な種類の寿司が贅沢なひとときを約束します。',
            'price' => 9800.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 20,
            'name' => '木船の海の恵みディナーコース',
            'description' => '市場から直接仕入れた新鮮な海の幸を活かしたディナーコース。寿司だけでなく、繊細で美味しい一品料理も楽しめる、至福の料理体験を提供いたします。',
            'price' => 12500.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('dishes')->insert([
            'shop_id' => 20,
            'name' => '木船のドリンクと共に楽しむセレクト寿司プレート',
            'description' => 'ドリンクと共にお楽しみいただく、種類豊富な寿司プレート。自家製の特製タレや、新しい組み合わせの寿司が味わえるプレミアムなセット。素材にこだわった逸品が勢揃いです。',
            'price' => 6000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
