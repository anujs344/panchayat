function init_slider(id) {
    let wrapper = $(id).find(".slider__wrapper");
    let container = $(wrapper).find(".slider__container");
    let element = $(wrapper).find(".slider__element");
    let slideCount = element.length;
    let containerWidth = 100 * (slideCount + 1) + "%";
  
    $(container).css({ width: containerWidth });
    $(id).find(".slider__element:last-child").prependTo(container);
  
    $(id)
      .find(".slider__element")
      .each(function () {
        $(this).css("width", 100 / (slideCount + 1) + "%");
      });
  
    function moveLeft() {
      container.animate(
        {
          left: +element.width()
        },
        400,
        function () {
          $(id).find(".slider__element:last-child").prependTo(container);
          container.css("left", "");
        }
      );
    }
  
    function moveRight() {
      container.animate(
        {
          left: -element.width()
        },
        400,
        function () {
          $(id).find(".slider__element:first-child").appendTo(container);
          container.css("left", "");
        }
      );
    }
  
    $(id)
      .find(".slider__prev")
      .click(function (e) {
        e.preventDefault();
        moveLeft();
      });
  
    $(id)
      .find(".slider__next")
      .click(function (e) {
        e.preventDefault();
        moveRight();
      });
  }
  
  $(document).ready(function () {
    init_slider("#swt_slider");
  });
  