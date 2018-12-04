/*
<div class="card col-4" style="width: 18rem;">
    <img class="card-img-top" src=".../100px180/" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Название карточки</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
    </div>
</div>
*/
var catalog = $('#js-catalog');

$(document).ready(function(){
  var elems;
  var id = 1;
  http(id);
  console.log(elems);
});

async function http(id){
  return await $.ajax({
    url:`index.php?id={id}`,
    async: false,
    success: function(data) {
      return data;
    }
  });
}