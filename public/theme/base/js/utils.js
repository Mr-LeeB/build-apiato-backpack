showCoin = function($el,$speed,$times){
  let $url = typeof $asset_url != 'undefined' ? '.' : $asset_url;
  let $self = typeof $el != 'undefined' ? $el : $('body');
  let $coinSpeed = typeof $speed != 'undefined' ? $speed : 600;
  let $coinTimes = typeof $times != 'undefined' ? $times : 6;
  let $coinShowTime = $coinSpeed * $coinTimes;
  let $coin = '<div class="coin-wrapper"><div class="coin-anim"></div></div>';
  let $sound = new Audio( $url + '/files/sound/coin-3.wav');
  if ($self.css('position') == 'static') {
    $self.addClass('relative-pos');
  }
  $sound.play();
  $self.append($coin);
  let moreCoin = setInterval(function(){
    let $newsound = new Audio($url + '/files/sound/coin-3.wav');
    $self.children('.coin-wrapper').append('<div class="coin-anim"></div>');
    $newsound.play();
  },$coinSpeed);
  setTimeout(function(){
    clearInterval(moreCoin);
    hideCoin($self);
  },$coinShowTime);
}
hideCoin = function($el){
  let $self = typeof $el != 'undefined' ? $el : $('body');
  if ($self.hasClass('relative-pos')) {
    $self.removeClass('relative-pos');
  }
  $self.children('.coin-wrapper').fadeOut(function(){
      $(this).remove();
  });
}
formatStringToNumber = function(string,$type) {
  let s = String(string).replaceAll('.','');
  let type = typeof $type === 'undefined' ? 'float' : $type;
  if (type == 'decimals') {
    s = String(s).replaceAll(',','.');
  } else {
    s = s.split(',')[0];
  }
  return Number(s);
}
formatNumber = function(number, $decimals, $decimalDelimiter, $thousandDelimiter) {
  let decimals = isNaN($decimals = Math.abs($decimals)) ? 0 : $decimals;
  let decimalDelimiter = typeof $decimalDelimiter === 'undefined' ? "," : $decimalDelimiter;
  let thousandDelimiter = typeof $thousandDelimiter === 'undefined' ? "." : $thousandDelimiter; 
  var
    s = number < 0 ? "-" : "",
    n = Math.abs(+number || 0).toFixed(decimals), 
    i = String(parseInt(n)), 
    j = (i.length > 3 ? i.length % 3 : 0);
  
  return s + (j ? i.substr(0, j) + thousandDelimiter : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousandDelimiter) + (decimals ? decimalDelimiter + Math.abs(n - i).toFixed(decimals).slice(2) : "");
}
countNumber = function($el,$from,$to,$duration,$decimals) {
  let $nDecimals = typeof $decimals === 'undefined' ? 0 : $decimals;
  let $type = $nDecimals > 0 ? 'decimals' : 'float';
  let $fromTarget = formatStringToNumber($from,$type);
  let $toTarget = formatStringToNumber($to,$type);
  $el.addClass('running');
  $({someValue: $fromTarget}).animate({someValue: $toTarget}, {
      duration: $duration,
      easing: 'linear', // can be anything
      step: function() { // called on every step
          // Update the element's text with rounded-up value:
          let $number = formatNumber(this.someValue,$nDecimals);
          $el.text($number);
      },
      complete : function(){
          $el.text($to);
          $el.attr('data-from',$to);
          $el.removeClass('running');
      }
  });
}
animNumber = function($id){
  if (typeof $id !== 'undefined') {
    let $target = $('#'+$id);
    animNumberRun($target);
  } else {
    $('.count.anim').each(function(){
      let $target = $(this);
      animNumberRun($target);
    });  
  }
}
animNumberRun = function($target) {
  if (!$target.hasClass('running')) {
    let 
      $el = $self = $target,
      $type = $self.data('type');
      $decimals = typeof $type == 'undefined' ? 'float' : $type;
      $from = formatStringToNumber($self.attr('data-from'),$decimals) > 0 ? $self.attr('data-from') : 0,
      $to = formatStringToNumber($self.attr('data-to'),$decimals) > 0 ? $self.attr('data-to') : 0,
      $duration = typeof $self.data('duration') != 'undefined' ? $self.data('duration') : 5000;
    if ($from !== $to) {
      if ($type == 'decimals') {
        countNumber($el,$from,$to,$duration,2);
      } else {
        countNumber($el,$from,$to,$duration,0);
      }
    }
  }
}