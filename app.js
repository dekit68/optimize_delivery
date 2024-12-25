$(document).ready(function() {
    const lastContent = localStorage.getItem('lastContent');
    if (lastContent) {
        $(".contents").hide();
        $("#" + lastContent).fadeIn();
    } else {
        $(".contents").hide();
        $(".contents").first().fadeIn();
    }
    $(".nav-content").on("click", function(e) {
        e.preventDefault();
        let show = $(this).data("content");
        $(".contents").hide();
        $("#" + show).fadeIn();
        localStorage.setItem('lastContent', show);
    })
})
  
  $(document).ready(function(){
      $('#searchInput').on('keyup', function() {
          var filter = $(this).val().toLowerCase();
          $('#tableBody tr').filter(function() {
              var name = $(this).find('td:nth-child(2)').text().toLowerCase();
              var surname = $(this).find('td:nth-child(3)').text().toLowerCase();
                      
              if (name.indexOf(filter) > -1 || surname.indexOf(filter) > -1) {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });
      });
  });
  
  $(document).ready(function() {
      $('#searchfood').on('keyup', function() {
          var searchQuery = $(this).val().toLowerCase(); 
  
          $('#foodCards .food-card').each(function() {
              var foodName = $(this).find('.card-title').text().toLowerCase();
              var foodDescription = $(this).find('.card-text').text().toLowerCase();
  
              if (foodName.includes(searchQuery) || foodDescription.includes(searchQuery)) {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });
      });
  
      // ฟังก์ชันสำหรับเลือกประเภทอาหาร
      $('#foodTypeSelect').on('change', function() {
          var selectedFoodType = $(this).val().toLowerCase();
  
          $('#foodCards .food-card').each(function() {
              var foodType = $(this).data('food-type').toLowerCase();
  
              // หากประเภทอาหารตรงกับการเลือกให้แสดงการ์ด
              if (foodType.includes(selectedFoodType) || selectedFoodType === "") {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });
      });
  
      $('#shopSelect').on('change', function() {
          var selectedShop = $(this).val().toLowerCase();
  
          $('#foodCards .food-card').each(function() {
              var shop = $(this).data('shop').toLowerCase();
  
              if (shop.includes(selectedShop) || selectedShop === "") {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });
      });
  });