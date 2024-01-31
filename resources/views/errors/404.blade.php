@include('includes._header_error')
<main class="main"
  style="background-image: -webkit-gradient(
  linear,
  left top,
  right top,
  from(rgba(0, 0, 0, 0.9)),
  to(rgba(0, 0, 0, 0.5))
  ),
  url('{{ asset('img/nhl-logo.webp') }}');
  background-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.9),
    rgba(0, 0, 0, 0.5)
  ),
  url('{{ asset('img/nhl-logo.webp') }}'); background-size: contain; background-position: center;">
  <div class="main-container"
    style="background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(245, 245, 245, 1)),
    to(rgba(245, 245, 245, 0.75))
    ),
    url('{{ asset('img/nhl-logo.webp') }}');
    background-image: linear-gradient(
        90deg,
        rgba(245, 245, 245, 1),
        rgba(245, 245, 245, 0.75)
    ),
    url('{{ asset('img/nhl-logo.webp') }}'); background-size: contain; background-position: center;">
    <div class="error-response-container">
      <h2>{{ $message }}</h2>
      <p>Use the Home button above to go back.</p>
    </div>
  </div>
</main>
@include('includes._footer_error')
