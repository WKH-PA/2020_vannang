
"function" != typeof Object.create && (Object.create = function(n) {
  function t() {}
  return t.prototype = n, new t
 }),
 function(n, t, i) {
  var r = {
   init: function(t, i) {
    this.$elem = n(i);
    this.options = n.extend({}, n.fn.owlCarousel.options, this.$elem.data(), t);
    this.userOptions = t;
    this.loadContent()
   },
   loadContent: function() {
    function r(n) {
     var i, r = "";
     if ("function" == typeof t.options.jsonSuccess) t.options.jsonSuccess.apply(this, [n]);
     else {
      for (i in n.owl) n.owl.hasOwnProperty(i) && (r += n.owl[i].item);
      t.$elem.html(r)
     }
     t.logIn()
    }
    var t = this,
     i;
    "function" == typeof t.options.beforeInit && t.options.beforeInit.apply(this, [t.$elem]);
    "string" == typeof t.options.jsonPath ? (i = t.options.jsonPath, n.getJSON(i, r)) : t.logIn()
   },
   logIn: function() {
    this.$elem.data("owl-originalStyles", this.$elem.attr("style"));
    this.$elem.data("owl-originalClasses", this.$elem.attr("class"));
    this.$elem.css({
     opacity: 0
    });
    this.orignalItems = this.options.items;
    this.checkBrowser();
    this.wrapperWidth = 0;
    this.checkVisible = null;
    this.setVars()
   },
   setVars: function() {
    if (0 === this.$elem.children().length) return !1;
    this.baseClass();
    this.eventTypes();
    this.$userItems = this.$elem.children();
    this.itemsAmount = this.$userItems.length;
    this.wrapItems();
    this.$owlItems = this.$elem.find(".owl-item");
    this.$owlWrapper = this.$elem.find(".owl-wrapper");
    this.playDirection = "next";
    this.prevItem = 0;
    this.prevArr = [0];
    this.currentItem = 0;
    this.customEvents();
    this.onStartup()
   },
   onStartup: function() {
    this.updateItems();
    this.calculateAll();
    this.buildControls();
    this.updateControls();
    this.response();
    this.moveEvents();
    this.stopOnHover();
    this.owlStatus();
    !1 !== this.options.transitionStyle && this.transitionTypes(this.options.transitionStyle);
    !0 === this.options.autoPlay && (this.options.autoPlay = 5e3);
    this.play();
    this.$elem.find(".owl-wrapper").css("display", "block");
    this.$elem.is(":visible") ? this.$elem.css("opacity", 1) : this.watchVisibility();
    this.onstartup = !1;
    this.eachMoveUpdate();
    "function" == typeof this.options.afterInit && this.options.afterInit.apply(this, [this.$elem])
   },
   eachMoveUpdate: function() {
    !0 === this.options.lazyLoad && this.lazyLoad();
    !0 === this.options.autoHeight && this.autoHeight();
    this.onVisibleItems();
    "function" == typeof this.options.afterAction && this.options.afterAction.apply(this, [this.$elem])
   },
   updateVars: function() {
    "function" == typeof this.options.beforeUpdate && this.options.beforeUpdate.apply(this, [this.$elem]);
    this.watchVisibility();
    this.updateItems();
    this.calculateAll();
    this.updatePosition();
    this.updateControls();
    this.eachMoveUpdate();
    "function" == typeof this.options.afterUpdate && this.options.afterUpdate.apply(this, [this.$elem])
   },
   reload: function() {
    var n = this;
    t.setTimeout(function() {
     n.updateVars()
    }, 0)
   },
   watchVisibility: function() {
    var n = this;
    if (!1 === n.$elem.is(":visible")) n.$elem.css({
     opacity: 0
    }), t.clearInterval(n.autoPlayInterval), t.clearInterval(n.checkVisible);
    else return !1;
    n.checkVisible = t.setInterval(function() {
     n.$elem.is(":visible") && (n.reload(), n.$elem.animate({
      opacity: 1
     }, 200), t.clearInterval(n.checkVisible))
    }, 500)
   },
   wrapItems: function() {
    this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"><\/div>');
    this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">');
    this.wrapperOuter = this.$elem.find(".owl-wrapper-outer");
    this.$elem.css("display", "block")
   },
   baseClass: function() {
    var n = this.$elem.hasClass(this.options.baseClass),
     t = this.$elem.hasClass(this.options.theme);
    n || this.$elem.addClass(this.options.baseClass);
    t || this.$elem.addClass(this.options.theme)
   },
   updateItems: function() {
    var t, i;
    if (!1 === this.options.responsive) return !1;
    if (!0 === this.options.singleItem) return this.options.items = this.orignalItems = 1, this.options.itemsCustom = !1, this.options.itemsDesktop = !1, this.options.itemsDesktopSmall = !1, this.options.itemsTablet = !1, this.options.itemsTabletSmall = !1, this.options.itemsMobile = !1;
    if (t = n(this.options.responsiveBaseWidth).width(), t > (this.options.itemsDesktop[0] || this.orignalItems) && (this.options.items = this.orignalItems), !1 !== this.options.itemsCustom)
     for (this.options.itemsCustom.sort(function(n, t) {
       return n[0] - t[0]
      }), i = 0; i < this.options.itemsCustom.length; i += 1) this.options.itemsCustom[i][0] <= t && (this.options.items = this.options.itemsCustom[i][1]);
    else t <= this.options.itemsDesktop[0] && !1 !== this.options.itemsDesktop && (this.options.items = this.options.itemsDesktop[1]), t <= this.options.itemsDesktopSmall[0] && !1 !== this.options.itemsDesktopSmall && (this.options.items = this.options.itemsDesktopSmall[1]), t <= this.options.itemsTablet[0] && !1 !== this.options.itemsTablet && (this.options.items = this.options.itemsTablet[1]), t <= this.options.itemsTabletSmall[0] && !1 !== this.options.itemsTabletSmall && (this.options.items = this.options.itemsTabletSmall[1]), t <= this.options.itemsMobile[0] && !1 !== this.options.itemsMobile && (this.options.items = this.options.itemsMobile[1]);
    this.options.items > this.itemsAmount && !0 === this.options.itemsScaleUp && (this.options.items = this.itemsAmount)
   },
   response: function() {
    var i = this,
     u, r;
    if (!0 !== i.options.responsive) return !1;
    r = n(t).width();
    i.resizer = function() {
     n(t).width() !== r && (!1 !== i.options.autoPlay && t.clearInterval(i.autoPlayInterval), t.clearTimeout(u), u = t.setTimeout(function() {
      r = n(t).width();
      i.updateVars()
     }, i.options.responsiveRefreshRate))
    };
    n(t).resize(i.resizer)
   },
   updatePosition: function() {
    this.jumpTo(this.currentItem);
    !1 !== this.options.autoPlay && this.checkAp()
   },
   appendItemsSizes: function() {
    var t = this,
     i = 0,
     r = t.itemsAmount - t.options.items;
    t.$owlItems.each(function(u) {
     var f = n(this);
     f.css({
      width: t.itemWidth
     }).data("owl-item", Number(u));
     (0 == u % t.options.items || u === r) && (u > r || (i += 1));
     f.data("owl-roundPages", i)
    })
   },
   appendWrapperSizes: function() {
    this.$owlWrapper.css({
     width: this.$owlItems.length * this.itemWidth * 2,
     left: 0
    });
    this.appendItemsSizes()
   },
   calculateAll: function() {
    this.calculateWidth();
    this.appendWrapperSizes();
    this.loops();
    this.max()
   },
   calculateWidth: function() {
    this.itemWidth = Math.round(this.$elem.width() / this.options.items)
   },
   max: function() {
    var n = -1 * (this.itemsAmount * this.itemWidth - this.options.items * this.itemWidth);
    return this.options.items > this.itemsAmount ? this.maximumPixels = n = this.maximumItem = 0 : (this.maximumItem = this.itemsAmount - this.options.items, this.maximumPixels = n), n
   },
   min: function() {
    return 0
   },
   loops: function() {
    var r = 0,
     u = 0,
     t, i;
    for (this.positionsInArray = [0], this.pagesInArray = [], t = 0; t < this.itemsAmount; t += 1) u += this.itemWidth, this.positionsInArray.push(-u), !0 === this.options.scrollPerPage && (i = n(this.$owlItems[t]), i = i.data("owl-roundPages"), i !== r && (this.pagesInArray[r] = this.positionsInArray[t], r = i))
   },
   buildControls: function() {
    (!0 === this.options.navigation || !0 === this.options.pagination) && (this.owlControls = n('<div class="owl-controls"/>').toggleClass("clickable", !this.browser.isTouch).appendTo(this.$elem));
    !0 === this.options.pagination && this.buildPagination();
    !0 === this.options.navigation && this.buildButtons()
   },
   buildButtons: function() {
    var t = this,
     i = n('<div class="owl-buttons"/>');
    t.owlControls.append(i);
    t.buttonPrev = n("<div/>", {
     "class": "owl-prev",
     html: t.options.navigationText[0] || ""
    });
    t.buttonNext = n("<div/>", {
     "class": "owl-next",
     html: t.options.navigationText[1] || ""
    });
    i.append(t.buttonPrev).append(t.buttonNext);
    i.on("touchstart.owlControls mousedown.owlControls", 'div[class^="owl"]', function(n) {
     n.preventDefault()
    });
    i.on("touchend.owlControls mouseup.owlControls", 'div[class^="owl"]', function(i) {
     i.preventDefault();
     n(this).hasClass("owl-next") ? t.next() : t.prev()
    })
   },
   buildPagination: function() {
    var t = this;
    t.paginationWrapper = n('<div class="owl-pagination"/>');
    t.owlControls.append(t.paginationWrapper);
    t.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function(i) {
     i.preventDefault();
     Number(n(this).data("owl-page")) !== t.currentItem && t.goTo(Number(n(this).data("owl-page")), !0)
    })
   },
   updatePagination: function() {
    var r, u, f, t, i, e;
    if (!1 === this.options.pagination) return !1;
    for (this.paginationWrapper.html(""), r = 0, u = this.itemsAmount - this.itemsAmount % this.options.items, t = 0; t < this.itemsAmount; t += 1) 0 == t % this.options.items && (r += 1, u === t && (f = this.itemsAmount - this.options.items), i = n("<div/>", {
     "class": "owl-page"
    }), e = n("<span><\/span>", {
     text: !0 === this.options.paginationNumbers ? r : "",
     "class": !0 === this.options.paginationNumbers ? "owl-numbers" : ""
    }), i.append(e), i.data("owl-page", u === t ? f : t), i.data("owl-roundPages", r), this.paginationWrapper.append(i));
    this.checkPagination()
   },
   checkPagination: function() {
    var t = this;
    if (!1 === t.options.pagination) return !1;
    t.paginationWrapper.find(".owl-page").each(function() {
     n(this).data("owl-roundPages") === n(t.$owlItems[t.currentItem]).data("owl-roundPages") && (t.paginationWrapper.find(".owl-page").removeClass("active"), n(this).addClass("active"))
    })
   },
   checkNavigation: function() {
    if (!1 === this.options.navigation) return !1;
    !1 === this.options.rewindNav && (0 === this.currentItem && 0 === this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.addClass("disabled")) : 0 === this.currentItem && 0 !== this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.removeClass("disabled")) : this.currentItem === this.maximumItem ? (this.buttonPrev.removeClass("disabled"), this.buttonNext.addClass("disabled")) : 0 !== this.currentItem && this.currentItem !== this.maximumItem && (this.buttonPrev.removeClass("disabled"), this.buttonNext.removeClass("disabled")))
   },
   updateControls: function() {
    this.updatePagination();
    this.checkNavigation();
    this.owlControls && (this.options.items >= this.itemsAmount ? this.owlControls.hide() : this.owlControls.show())
   },
   destroyControls: function() {
    this.owlControls && this.owlControls.remove()
   },
   next: function(n) {
    if (this.isTransition) return !1;
    if (this.currentItem += !0 === this.options.scrollPerPage ? this.options.items : 1, this.currentItem > this.maximumItem + (!0 === this.options.scrollPerPage ? this.options.items - 1 : 0))
     if (!0 === this.options.rewindNav) this.currentItem = 0, n = "rewind";
     else return this.currentItem = this.maximumItem, !1;
    this.goTo(this.currentItem, n)
   },
   prev: function(n) {
    if (this.isTransition) return !1;
    if (this.currentItem = !0 === this.options.scrollPerPage && 0 < this.currentItem && this.currentItem < this.options.items ? 0 : this.currentItem - (!0 === this.options.scrollPerPage ? this.options.items : 1), 0 > this.currentItem)
     if (!0 === this.options.rewindNav) this.currentItem = this.maximumItem, n = "rewind";
     else return this.currentItem = 0, !1;
    this.goTo(this.currentItem, n)
   },
   goTo: function(n, i, r) {
    var u = this;
    if (u.isTransition) return !1;
    if ("function" == typeof u.options.beforeMove && u.options.beforeMove.apply(this, [u.$elem]), n >= u.maximumItem ? n = u.maximumItem : 0 >= n && (n = 0), u.currentItem = u.owl.currentItem = n, !1 !== u.options.transitionStyle && "drag" !== r && 1 === u.options.items && !0 === u.browser.support3d) return u.swapSpeed(0), !0 === u.browser.support3d ? u.transition3d(u.positionsInArray[n]) : u.css2slide(u.positionsInArray[n], 1), u.afterGo(), u.singleItemTransition(), !1;
    n = u.positionsInArray[n];
    !0 === u.browser.support3d ? (u.isCss3Finish = !1, !0 === i ? (u.swapSpeed("paginationSpeed"), t.setTimeout(function() {
     u.isCss3Finish = !0
    }, u.options.paginationSpeed)) : "rewind" === i ? (u.swapSpeed(u.options.rewindSpeed), t.setTimeout(function() {
     u.isCss3Finish = !0
    }, u.options.rewindSpeed)) : (u.swapSpeed("slideSpeed"), t.setTimeout(function() {
     u.isCss3Finish = !0
    }, u.options.slideSpeed)), u.transition3d(n)) : !0 === i ? u.css2slide(n, u.options.paginationSpeed) : "rewind" === i ? u.css2slide(n, u.options.rewindSpeed) : u.css2slide(n, u.options.slideSpeed);
    u.afterGo()
   },
   jumpTo: function(n) {
    "function" == typeof this.options.beforeMove && this.options.beforeMove.apply(this, [this.$elem]);
    n >= this.maximumItem || -1 === n ? n = this.maximumItem : 0 >= n && (n = 0);
    this.swapSpeed(0);
    !0 === this.browser.support3d ? this.transition3d(this.positionsInArray[n]) : this.css2slide(this.positionsInArray[n], 1);
    this.currentItem = this.owl.currentItem = n;
    this.afterGo()
   },
   afterGo: function() {
    this.prevArr.push(this.currentItem);
    this.prevItem = this.owl.prevItem = this.prevArr[this.prevArr.length - 2];
    this.prevArr.shift(0);
    this.prevItem !== this.currentItem && (this.checkPagination(), this.checkNavigation(), this.eachMoveUpdate(), !1 !== this.options.autoPlay && this.checkAp());
    "function" == typeof this.options.afterMove && this.prevItem !== this.currentItem && this.options.afterMove.apply(this, [this.$elem])
   },
   stop: function() {
    this.apStatus = "stop";
    t.clearInterval(this.autoPlayInterval)
   },
   checkAp: function() {
    "stop" !== this.apStatus && this.play()
   },
   play: function() {
    var n = this;
    if (n.apStatus = "play", !1 === n.options.autoPlay) return !1;
    t.clearInterval(n.autoPlayInterval);
    n.autoPlayInterval = t.setInterval(function() {
     n.next(!0)
    }, n.options.autoPlay)
   },
   swapSpeed: function(n) {
    "slideSpeed" === n ? this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)) : "paginationSpeed" === n ? this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)) : "string" != typeof n && this.$owlWrapper.css(this.addCssSpeed(n))
   },
   addCssSpeed: function(n) {
    return {
     "-webkit-transition": "all " + n + "ms ease",
     "-moz-transition": "all " + n + "ms ease",
     "-o-transition": "all " + n + "ms ease",
     transition: "all " + n + "ms ease"
    }
   },
   removeTransition: function() {
    return {
     "-webkit-transition": "",
     "-moz-transition": "",
     "-o-transition": "",
     transition: ""
    }
   },
   doTranslate: function(n) {
    return {
     "-webkit-transform": "translate3d(" + n + "px, 0px, 0px)",
     "-moz-transform": "translate3d(" + n + "px, 0px, 0px)",
     "-o-transform": "translate3d(" + n + "px, 0px, 0px)",
     "-ms-transform": "translate3d(" + n + "px, 0px, 0px)",
     transform: "translate3d(" + n + "px, 0px,0px)"
    }
   },
   transition3d: function(n) {
    this.$owlWrapper.css(this.doTranslate(n))
   },
   css2move: function(n) {
    this.$owlWrapper.css({
     left: n
    })
   },
   css2slide: function(n, t) {
    var i = this;
    i.isCssFinish = !1;
    i.$owlWrapper.stop(!0, !0).animate({
     left: n
    }, {
     duration: t || i.options.slideSpeed,
     complete: function() {
      i.isCssFinish = !0
     }
    })
   },
   checkBrowser: function() {
    var n = i.createElement("div");
    n.style.cssText = "  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
    n = n.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g);
    this.browser = {
     support3d: null !== n && 1 === n.length,
     isTouch: "ontouchstart" in t || t.navigator.msMaxTouchPoints
    }
   },
   moveEvents: function() {
    (!1 !== this.options.mouseDrag || !1 !== this.options.touchDrag) && (this.gestures(), this.disabledEvents())
   },
   eventTypes: function() {
    var n = ["s", "e", "x"];
    this.ev_types = {};
    !0 === this.options.mouseDrag && !0 === this.options.touchDrag ? n = ["touchstart.owl mousedown.owl", "touchmove.owl mousemove.owl", "touchend.owl touchcancel.owl mouseup.owl"] : !1 === this.options.mouseDrag && !0 === this.options.touchDrag ? n = ["touchstart.owl", "touchmove.owl", "touchend.owl touchcancel.owl"] : !0 === this.options.mouseDrag && !1 === this.options.touchDrag && (n = ["mousedown.owl", "mousemove.owl", "mouseup.owl"]);
    this.ev_types.start = n[0];
    this.ev_types.move = n[1];
    this.ev_types.end = n[2]
   },
   disabledEvents: function() {
    this.$elem.on("dragstart.owl", function(n) {
     n.preventDefault()
    });
    this.$elem.on("mousedown.disableTextSelect", function(t) {
     return n(t.target).is("input, textarea, select, option")
    })
   },
   gestures: function() {
    function f(n) {
     if (void 0 !== n.touches) return {
      x: n.touches[0].pageX,
      y: n.touches[0].pageY
     };
     if (void 0 === n.touches) {
      if (void 0 !== n.pageX) return {
       x: n.pageX,
       y: n.pageY
      };
      if (void 0 === n.pageX) return {
       x: n.clientX,
       y: n.clientY
      }
     }
    }

    function e(t) {
     "on" === t ? (n(i).on(r.ev_types.move, o), n(i).on(r.ev_types.end, s)) : "off" === t && (n(i).off(r.ev_types.move), n(i).off(r.ev_types.end))
    }

    function o(e) {
     e = e.originalEvent || e || t.event;
     r.newPosX = f(e).x - u.offsetX;
     r.newPosY = f(e).y - u.offsetY;
     r.newRelativeX = r.newPosX - u.relativePos;
     "function" == typeof r.options.startDragging && !0 !== u.dragging && 0 !== r.newRelativeX && (u.dragging = !0, r.options.startDragging.apply(r, [r.$elem]));
     (8 < r.newRelativeX || -8 > r.newRelativeX) && !0 === r.browser.isTouch && (void 0 !== e.preventDefault ? e.preventDefault() : e.returnValue = !1, u.sliding = !0);
     (10 < r.newPosY || -10 > r.newPosY) && !1 === u.sliding && n(i).off("touchmove.owl");
     r.newPosX = Math.max(Math.min(r.newPosX, r.newRelativeX / 5), r.maximumPixels + r.newRelativeX / 5);
     !0 === r.browser.support3d ? r.transition3d(r.newPosX) : r.css2move(r.newPosX)
    }

    function s(i) {
     i = i.originalEvent || i || t.event;
     var f;
     i.target = i.target || i.srcElement;
     u.dragging = !1;
     !0 !== r.browser.isTouch && r.$owlWrapper.removeClass("grabbing");
     r.dragDirection = r.owl.dragDirection = 0 > r.newRelativeX ? "left" : "right";
     0 !== r.newRelativeX && (f = r.getNewPosition(), r.goTo(f, !1, "drag"), u.targetElement === i.target && !0 !== r.browser.isTouch && (n(i.target).on("click.disable", function(t) {
      t.stopImmediatePropagation();
      t.stopPropagation();
      t.preventDefault();
      n(t.target).off("click.disable")
     }), i = n._data(i.target, "events").click, f = i.pop(), i.splice(0, 0, f)));
     e("off")
    }
    var r = this,
     u = {
      offsetX: 0,
      offsetY: 0,
      baseElWidth: 0,
      relativePos: 0,
      position: null,
      minSwipe: null,
      maxSwipe: null,
      sliding: null,
      dargging: null,
      targetElement: null
     };
    r.isCssFinish = !0;
    r.$elem.on(r.ev_types.start, ".owl-wrapper", function(i) {
     i = i.originalEvent || i || t.event;
     var o;
     if (3 === i.which) return !1;
     if (!(r.itemsAmount <= r.options.items)) {
      if (!1 === r.isCssFinish && !r.options.dragBeforeAnimFinish || !1 === r.isCss3Finish && !r.options.dragBeforeAnimFinish) return !1;
      !1 !== r.options.autoPlay && t.clearInterval(r.autoPlayInterval);
      !0 === r.browser.isTouch || r.$owlWrapper.hasClass("grabbing") || r.$owlWrapper.addClass("grabbing");
      r.newPosX = 0;
      r.newRelativeX = 0;
      n(this).css(r.removeTransition());
      o = n(this).position();
      u.relativePos = o.left;
      u.offsetX = f(i).x - o.left;
      u.offsetY = f(i).y - o.top;
      e("on");
      u.sliding = !1;
      u.targetElement = i.target || i.srcElement
     }
    })
   },
   getNewPosition: function() {
    var n = this.closestItem();
    return n > this.maximumItem ? n = this.currentItem = this.maximumItem : 0 <= this.newPosX && (this.currentItem = n = 0), n
   },
   closestItem: function() {
    var t = this,
     i = !0 === t.options.scrollPerPage ? t.pagesInArray : t.positionsInArray,
     u = t.newPosX,
     r = null;
    return n.each(i, function(f, e) {
     u - t.itemWidth / 20 > i[f + 1] && u - t.itemWidth / 20 < e && "left" === t.moveDirection() ? (r = e, t.currentItem = !0 === t.options.scrollPerPage ? n.inArray(r, t.positionsInArray) : f) : u + t.itemWidth / 20 < e && u + t.itemWidth / 20 > (i[f + 1] || i[f] - t.itemWidth) && "right" === t.moveDirection() && (!0 === t.options.scrollPerPage ? (r = i[f + 1] || i[i.length - 1], t.currentItem = n.inArray(r, t.positionsInArray)) : (r = i[f + 1], t.currentItem = f + 1))
    }), t.currentItem
   },
   moveDirection: function() {
    var n;
    return 0 > this.newRelativeX ? (n = "right", this.playDirection = "next") : (n = "left", this.playDirection = "prev"), n
   },
   customEvents: function() {
    var n = this;
    n.$elem.on("owl.next", function() {
     n.next()
    });
    n.$elem.on("owl.prev", function() {
     n.prev()
    });
    n.$elem.on("owl.play", function(t, i) {
     n.options.autoPlay = i;
     n.play();
     n.hoverStatus = "play"
    });
    n.$elem.on("owl.stop", function() {
     n.stop();
     n.hoverStatus = "stop"
    });
    n.$elem.on("owl.goTo", function(t, i) {
     n.goTo(i)
    });
    n.$elem.on("owl.jumpTo", function(t, i) {
     n.jumpTo(i)
    })
   },
   stopOnHover: function() {
    var n = this;
    !0 === n.options.stopOnHover && !0 !== n.browser.isTouch && !1 !== n.options.autoPlay && (n.$elem.on("mouseover", function() {
     n.stop()
    }), n.$elem.on("mouseout", function() {
     "stop" !== n.hoverStatus && n.play()
    }))
   },
   lazyLoad: function() {
    var r, t, u, i, f;
    if (!1 === this.options.lazyLoad) return !1;
    for (r = 0; r < this.itemsAmount; r += 1) t = n(this.$owlItems[r]), "loaded" !== t.data("owl-loaded") && (u = t.data("owl-item"), i = t.find(".lazyOwl"), "string" != typeof i.data("src") ? t.data("owl-loaded", "loaded") : (void 0 === t.data("owl-loaded") && (i.hide(), t.addClass("loading").data("owl-loaded", "checked")), (f = !0 === this.options.lazyFollow ? u >= this.currentItem : !0) && u < this.currentItem + this.options.items && i.length && this.lazyPreload(t, i)))
   },
   lazyPreload: function(n, i) {
    function u() {
     n.data("owl-loaded", "loaded").removeClass("loading");
     i.removeAttr("data-src");
     "fade" === r.options.lazyEffect ? i.fadeIn(400) : i.show();
     "function" == typeof r.options.afterLazyLoad && r.options.afterLazyLoad.apply(this, [r.$elem])
    }

    function f() {
     e += 1;
     r.completeImg(i.get(0)) || !0 === o ? u() : 100 >= e ? t.setTimeout(f, 100) : u()
    }
    var r = this,
     e = 0,
     o;
    "DIV" === i.prop("tagName") ? (i.css("background-image", "url(" + i.data("src") + ")"), o = !0) : i[0].src = i.data("src");
    f()
   },

   autoHeight: function() {
    function u() {
     var r = n(i.$owlItems[i.currentItem]).height();
     i.wrapperOuter.css("height", r + "px");
     i.wrapperOuter.hasClass("autoHeight") || t.setTimeout(function() {
      i.wrapperOuter.addClass("autoHeight")
     }, 0)
    }

    function f() {
     r += 1;
     i.completeImg(e.get(0)) ? u() : 100 >= r ? t.setTimeout(f, 100) : i.wrapperOuter.css("height", "")
    }
    var i = this,
     e = n(i.$owlItems[i.currentItem]).find("img"),
     r;
    void 0 !== e.get(0) ? (r = 0, f()) : u()
   },
   completeImg: function(n) {
    return !n.complete || "undefined" != typeof n.naturalWidth && 0 === n.naturalWidth ? !1 : !0
   },
   onVisibleItems: function() {
    var t;
    for (!0 === this.options.addClassActive && this.$owlItems.removeClass("active"), this.visibleItems = [], t = this.currentItem; t < this.currentItem + this.options.items; t += 1) this.visibleItems.push(t), !0 === this.options.addClassActive && n(this.$owlItems[t]).addClass("active");
    this.owl.visibleItems = this.visibleItems
   },
   transitionTypes: function(n) {
    this.outClass = "owl-" + n + "-out";
    this.inClass = "owl-" + n + "-in"
   },
   singleItemTransition: function() {
    var n = this,
     u = n.outClass,
     f = n.inClass,
     t = n.$owlItems.eq(n.currentItem),
     i = n.$owlItems.eq(n.prevItem),
     e = Math.abs(n.positionsInArray[n.currentItem]) + n.positionsInArray[n.prevItem],
     r = Math.abs(n.positionsInArray[n.currentItem]) + n.itemWidth / 2;
    n.isTransition = !0;
    n.$owlWrapper.addClass("owl-origin").css({
     "-webkit-transform-origin": r + "px",
     "-moz-perspective-origin": r + "px",
     "perspective-origin": r + "px"
    });
    i.css({
     position: "relative",
     left: e + "px"
    }).addClass(u).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function() {
     n.endPrev = !0;
     i.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");
     n.clearTransStyle(i, u)
    });
    t.addClass(f).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function() {
     n.endCurrent = !0;
     t.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");
     n.clearTransStyle(t, f)
    })
   },
   clearTransStyle: function(n, t) {
    n.css({
     position: "",
     left: ""
    }).removeClass(t);
    this.endPrev && this.endCurrent && (this.$owlWrapper.removeClass("owl-origin"), this.isTransition = this.endCurrent = this.endPrev = !1)
   },
   owlStatus: function() {
    this.owl = {
     userOptions: this.userOptions,
     baseElement: this.$elem,
     userItems: this.$userItems,
     owlItems: this.$owlItems,
     currentItem: this.currentItem,
     prevItem: this.prevItem,
     visibleItems: this.visibleItems,
     isTouch: this.browser.isTouch,
     browser: this.browser,
     dragDirection: this.dragDirection
    }
   },
   clearEvents: function() {
    this.$elem.off(".owl owl mousedown.disableTextSelect");
    n(i).off(".owl owl");
    n(t).off("resize", this.resizer)
   },
   unWrap: function() {
    0 !== this.$elem.children().length && (this.$owlWrapper.unwrap(), this.$userItems.unwrap().unwrap(), this.owlControls && this.owlControls.remove());
    this.clearEvents();
    this.$elem.attr("style", this.$elem.data("owl-originalStyles") || "").attr("class", this.$elem.data("owl-originalClasses"))
   },
   destroy: function() {
    this.stop();
    t.clearInterval(this.checkVisible);
    this.unWrap();
    this.$elem.removeData()
   },
   reinit: function(t) {
    t = n.extend({}, this.userOptions, t);
    this.unWrap();
    this.init(t, this.$elem)
   },
   addItem: function(n, t) {
    var i;
    if (!n) return !1;
    if (0 === this.$elem.children().length) return this.$elem.append(n), this.setVars(), !1;
    this.unWrap();
    i = void 0 === t || -1 === t ? -1 : t;
    i >= this.$userItems.length || -1 === i ? this.$userItems.eq(-1).after(n) : this.$userItems.eq(i).before(n);
    this.setVars()
   },
   removeItem: function(n) {
    if (0 === this.$elem.children().length) return !1;
    n = void 0 === n || -1 === n ? -1 : n;
    this.unWrap();
    this.$userItems.eq(n).remove();
    this.setVars()
   }
  };
  n.fn.owlCarousel = function(t) {
   return this.each(function() {
    if (!0 === n(this).data("owl-init")) return !1;
    n(this).data("owl-init", !0);
    var i = Object.create(r);
    i.init(t, this);
    n.data(this, "owlCarousel", i)
   })
  };
  n.fn.owlCarousel.options = {
   items: 5,
   itemsCustom: !1,
   itemsDesktop: [1199, 4],
   itemsDesktopSmall: [979, 3],
   itemsTablet: [768, 2],
   itemsTabletSmall: !1,
   itemsMobile: [479, 1],
   singleItem: !1,
   itemsScaleUp: !1,
   slideSpeed: 200,
   paginationSpeed: 800,
   rewindSpeed: 1e3,
   autoPlay: !1,
   stopOnHover: !1,
   navigation: !1,
   navigationText: ["‹", "›"],
   rewindNav: !0,
   scrollPerPage: !1,
   pagination: !0,
   paginationNumbers: !1,
   responsive: !0,
   responsiveRefreshRate: 200,
   responsiveBaseWidth: t,
   baseClass: "owl-carousel",
   theme: "owl-theme",
   lazyLoad: !1,
   lazyFollow: !0,
   lazyEffect: "fade",
   autoHeight: !1,
   jsonPath: !1,
   jsonSuccess: !1,
   dragBeforeAnimFinish: !0,
   mouseDrag: !0,
   touchDrag: !0,
   addClassActive: !1,
   transitionStyle: !1,
   beforeUpdate: !1,
   afterUpdate: !1,
   beforeInit: !1,
   afterInit: !1,
   beforeMove: !1,
   afterMove: !1,
   afterAction: !1,
   startDragging: !1,
   afterLazyLoad: !1
  }
 }(jQuery, window, document);
lastSuggest = (new Date).getTime();
$(window).load(function() {
 $(".colfoot li.showmore").click(function() {
  $(this).remove();
  $(".colfoot li.hidden").removeClass("hidden")
 });


});

$(window).load(function() {
 function i() {
  var n = this.currentItem;
  $("#sync2").find(".owl-item").removeClass("synced").eq(n).addClass("synced");
  $("#sync2").data("owlCarousel") !== undefined && r(n)
 }

 function r(t) {
  var i = n.data("owlCarousel").owl.visibleItems,
   r = t,
   u = !1;
  for (var f in i) r === i[f] && (u = !0);
  u === !1 ? r > i[i.length - 1] ? n.trigger("owl.goTo", r - i.length + 2) : (r - 1 == -1 && (r = 0), n.trigger("owl.goTo", r)) : r === i[i.length - 1] ? n.trigger("owl.goTo", i[1]) : r === i[0] && n.trigger("owl.goTo", r - 1)
 }
 var t = $("#sync1"),
  n = $("#sync2");
 t.owlCarousel({
  autoPlay: 5e3,
  singleItem: !0,
  slideSpeed: 500,
  navigation: !0,
  pagination: !1,
  afterAction: i,
  responsiveRefreshRate: 200,
  lazyLoad: !0,
  stopOnHover: !0
 });
 n.owlCarousel({
  items: 6,
  itemsDesktop: [1199, 5],
  itemsDesktopSmall: [979, 4],
  itemsTablet: [768, 3],
  itemsMobile: [479, 2],
  pagination: !1,
  responsiveRefreshRate: 100,
  afterInit: function(n) {
   n.find(".owl-item").eq(0).addClass("synced")
  }
 });
 $("#sync2").on("click", ".owl-item", function(n) {
  n.preventDefault();
  var i = $(this).data("owlItem");
  t.trigger("owl.goTo", i)
 });

});
$(window).on('load', function() {
   $(".dv-ul-menu.dv-ul-menu-child-on").show();
});