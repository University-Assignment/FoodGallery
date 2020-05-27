</div>
<br/>
</div>
</div>
<footer>
  <div class="container mt-4">
    <p class="text-center">과제 제작중 | <a href="?page=intro">윤정환</a></p><br/>
  </div>
</footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
  <script>
  var swiper = new Swiper('.swiper-container', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + '</span>';
      },
    },
    navigation : { // 네비게이션 설정
  		nextEl : '.swiper-button-next', // 다음 버튼 클래스명
  		prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
  	},
  });
  </script>
  </body>
</html>
