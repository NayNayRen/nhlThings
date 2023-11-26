@include('includes._header')
<main class="main">
  <div class="main-container">
    <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
  </div>
</main>
@include('includes._footer')
