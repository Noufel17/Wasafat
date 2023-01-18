// override `contains` function to make it case insenstive
$(function () {
  jQuery.expr[":"].contains = function (a, i, m) {
    return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
  };
  $("#search-bar").on("keyup", function () {
    $(".card").parent().removeClass("d-none");
    var filter = $(this).val(); // get the value of the input, which we filter on
    console.log(filter);
    $(".card-deck")
      .find('.card .card-body h5:not(:contains("' + filter + '"))')
      .parent()
      .parent()
      .parent()
      .addClass("d-none");
  });
  $("#sort-btn").on("click", function () {
    $(".card-deck .col")
      .sort(function (a, b) {
        return $(a).find(".card-title").text() > $(b).find(".card-title").text()
          ? 1
          : -1;
      })
      .appendTo(".card-deck");
  });
  // filtrage par fete
  $("#fete-filter").on("change", function () {
    var value = $(this).val();
    console.log(value);
  });
  $("#filter-btn").on("click", function () {
    $("#filters-form").removeClass("d-none");
  });
  $("#hide-filters-btn").on("click", function () {
    $("#filters-form").addClass("d-none");
  });

  // tableau d'ajout des etapes dans le formulaire d'ajout de recette
  $(".add-step-btn").on("click", function (e) {
    e.preventDefault();
    $("#etapes").prepend(`<div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-4 mb-3">
        <input type="number" name="numEtape[]" class="form-control" required
            placeholder="numéro de l'étape">
    </div>
    <div class="col-md-12 mb-3">
        <textarea name="descriptionEtape[]" class="form-control" required
            placeholder="description de l'étape"></textarea>
    </div>
    <div class="col-md-3 mb-3">
        <button class="btn btn-danger remove-step-btn">
            Supprimer Étape
        </button>
    </div>
</div>`);
  });
  $(document).on("click", ".remove-step-btn", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });
  // tableau d'ajout des ingredeints dans le formulaire d'ajout de recette
  function getIngredients() {
    $.ajax({
      type: "POST",
      url: "./getIngredients.php",
      data: { action: "test" },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);
        var options = "";
        for (elem in data) {
          console.log(elem);
          options +=
            "<option value=" +
            data[elem].idIngredient +
            ">" +
            data[elem].nomIngredient +
            "</option>";
        }
        var row =
          `<div class="row row-cols-1 row-cols-lg-4 mb-3">
        <div class="form-group col-md-4">
            <select name="idIngredient[]"
                class="form-control" required placeholder="choisir un ingredient">
                <option value="" selected>choisir ingrédient</option>
                ` +
          options +
          `
            </select>
        </div>
        <div class="col-md-3 mb-1">
            <input type="number" name="quantite[]" class="form-control" required
                placeholder="quantité de l'ingrédient">
        </div>
        <div class="col-md-3 mb-1">
            <input type="text" name="unite[]" class="form-control" 
                placeholder="unité de mesure">
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger remove-ing-btn">
                Supprimer Ingrédient
            </button>
        </div>
    </div>`;
        $("#ingredients").append(row);
      },
    });
  }

  $(".add-ing-btn").on("click", function (e) {
    e.preventDefault();
    getIngredients();
  });
  $(document).on("click", ".remove-ing-btn", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });
  // traitement de l'ajout des ingredients dans la page idee de recette
  function getIngs() {
    $.ajax({
      type: "POST",
      url: "./getIngredients.php",
      data: { action: "test" },
      success: function (response) {
        var data = JSON.parse(response);
        console.log(data);
        var options = "";
        for (elem in data) {
          console.log(elem);
          options +=
            "<option value=" +
            data[elem].idIngredient +
            ">" +
            data[elem].nomIngredient +
            "</option>";
        }
        var row =
          `<div class="row row-cols-2 mb-3">
          <div class="form-group cols-md-8">
              <select name="idIngredient[]" class="form-control" required placeholder="choisir un ingredient">
                  <option value="0" selected>choisir ingrédient</option>
                  ` +
          options +
          `
              </select>
          </div>
          <div class="">
              <center><button class="btn btn-danger remove-ing-btn-ir">
                      Supprimer ingrédient
                  </button></center>
          </div>
      </div>`;
        $("#ingredients").append(row);
      },
    });
  }

  $(".add-ing-btn-ir").on("click", function (e) {
    e.preventDefault();
    getIngs();
  });
  $(document).on("click", ".remove-ing-btn-ir", function (e) {
    e.preventDefault();
    $(this).parent().parent().parent().remove();
  });

  $(".add-para-btn").on("click", function (e) {
    e.preventDefault();
    $("#para").append(`<div class="col-md-12 mb-3">
    <label for="corps" class="form-label">Paragraphs</label>
    <textarea name="paragraph[]" class="form-control" style="height:200px" required
        placeholder="Paragraph"></textarea>
    <button type="button" class="btn btn-danger remove-para-btn mt-2">
        Supprimer paragraph
    </button>
</div>`);
  });
  $(document).on("click", ".remove-para-btn", function (e) {
    e.preventDefault();
    $(this).parent().remove();
  });
  $(".add-img-btn").on("click", function (e) {
    e.preventDefault();
    $(
      "#images"
    ).append(`<div class="form-group mb-3 row row-cols-2 align-items-center">
    <div class="col md-cols-8">
        <input class="form-control" type="file" id="newsImage" name="newsImages[]">
    </div>
    <div class="col md-cols-4">
        <button type="button" class="btn btn-danger remove-img-btn">
            Supprimer une image
        </button>
    </div>
</div>`);
  });
  $(document).on("click", ".remove-img-btn", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  $("input[name$='radio']").on("click", function (e) {
    var val = $(this).val();
    if (val === "recette") {
      $("#recette").removeClass("d-none");
      $("#news").addClass("d-none");
    }
    if (val === "news") {
      $("#news").removeClass("d-none");
      $("#recette").addClass("d-none");
    }
  });

  // for added ingredients and steps on edit

  $(".add-added-step-btn").on("click", function (e) {
    e.preventDefault();
    $("#etapes").prepend(`<div class="row row-cols-1 row-cols-md-3">
    <div class="col-md-4 mb-3">
        <input type="number" name="addedNumEtape[]" class="form-control" required
            placeholder="numéro de l'étape">
    </div>
    <div class="col-md-12 mb-3">
        <textarea name="addedDescriptionEtape[]" class="form-control" required
            placeholder="description de l'étape"></textarea>
    </div>
    <div class="col-md-3 mb-3">
        <button class="btn btn-danger remove-added-step-btn">
            Supprimer Étape
        </button>
    </div>
</div>`);
  });
  $(document).on("click", ".remove-added-step-btn", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });
  // tableau d'ajout des ingredeints dans le formulaire d'ajout de recette
  function getIngredients() {
    $.ajax({
      type: "POST",
      url: "./getIngredients.php",
      data: { action: "test" },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);
        var options = "";
        for (elem in data) {
          console.log(elem);
          options +=
            "<option value=" +
            data[elem].idIngredient +
            ">" +
            data[elem].nomIngredient +
            "</option>";
        }
        var row =
          `<div class="row row-cols-1 row-cols-lg-4 mb-3">
        <div class="form-group col-md-4">
            <select name="addedIdIngredient[]"
                class="form-control" required placeholder="choisir un ingredient">
                <option value="" selected>choisir ingrédient</option>
                ` +
          options +
          `
            </select>
        </div>
        <div class="col-md-3 mb-1">
            <input type="number" name="addedQuantite[]" class="form-control" required
                placeholder="quantité de l'ingrédient">
        </div>
        <div class="col-md-3 mb-1">
            <input type="text" name="addedUnite[]" class="form-control" 
                placeholder="unité de mesure">
        </div>
        <div class="col-md-3">
            <button class="btn btn-danger remove-added-ing-btn">
                Supprimer Ingrédient
            </button>
        </div>
    </div>`;
        $("#ingredients").append(row);
      },
    });
  }

  $(".add-added-ing-btn").on("click", function (e) {
    e.preventDefault();
    getIngredients();
  });
  $(document).on("click", ".remove-ing-btn", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });
});
