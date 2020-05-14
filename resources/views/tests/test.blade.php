test

<!-- 79 MVCの書き方２ -->
<!-- TestController.php【/app/Http/Controllers】で設定された$valuesを引き受けて表示するといもの。 -->
@foreach($values as $value)
<!-- {{}} 二重波カッコはXSS攻撃防止の為のhtmlspecialchars()を適用するという意味 -->
{{$value->id}}<br>
{{$value->text}}<br>
@endforeach