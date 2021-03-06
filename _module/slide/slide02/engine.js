bd.slide.Slide02 = function() {
	this.init.apply(this, arguments);
};

bd.slide.Slide02.prototype = {
	isReady: false,
	currentIndex: 0,
	interval: 10000,
	
	init: function() {
		this.isReady = true;
		
		var self = this;
		jQuery(window).resize(function(){
			self.resize();
		});
	},
	
	render: function( elem, autost, loop ) {
		var size = this.getPageSize();
		var self = this;
		this.images = [];
		jQuery('img', elem).each(function(i, imgTag){
			var img = new Image();
			img.src = imgTag.src;
			self.images.push(img);
		});
		
		this.container = jQuery('<div class="shift02"></div>').css({
			width: size.w,
			height: size.h,
			display: 'block',
			position: 'absolute',
			zIndex: -1,
			top: 0,
			left: 0,
			overflow: 'hidden'
		}).appendTo(document.body);
		
		jQuery('.thunder-bg').css('background', 'none');
		jQuery('.wind-bg').css('background', 'none');
		
		this.showImage(this.images[0]);
		
		jQuery(elem).remove();
		
		if (bd.util.onEditBlock() == false) {
			var self = this;
			setInterval(function(){ self.nextImage(); }, this.interval);
		}
	},
	
	calcImageSize: function( img ) {
		var size = this.getPageSize();
		
		// 短辺FIT
		var w = img.width;
		var h = img.height;
		
		if (w < h) {
			var ratio = size.w / w;
			w = size.w;
			h = h * ratio;
		} else {
			var ratio = size.h / h;
			w = w * ratio;
			h = size.h;
		}
		
		// 極端に長いケースへの対応
		if (w < size.w) {
			var ratio = size.w /w;
			w = size.w;
			h = h * ratio;
		}
		
		if (h < size.h) {
			var ratio = size.h / h;
			w = w * ratio;
			h = size.h;
		}
		
		// センタリング
		var l = (size.w - w) / 2;
		var t = (size.h - h) / 2;
		
		return {w:w, h:h, t:t, l:l};
	},
	
	showImage: function( img ) {
		var imgSize = this.calcImageSize( img );
		
		var zOrder = 0;
		var old = jQuery('img', this.container);
		if (old.length > 0) zOrder = old.css('z-index') + 1;
		
		var e = jQuery('<img />', {
			src: img.src,
			width: imgSize.w,
			height: imgSize.h
		}).css({
			position: 'absolute',
			zIndex: zOrder,
			top: imgSize.t,
			left: imgSize.l,
			display: 'none'
		});
		this.container.append(e);
		
		e.fadeIn(8000, function() {
			old.remove();
		});
	},
	
	nextImage: function() {
		if (this.currentIndex == this.images.length -1) this.currentIndex = -1;
		this.currentIndex++;
		var img = this.images[this.currentIndex];
		if (img.complete)
			this.showImage(img);
		else
			this.currentIndex--;
	},
	
	getPageSize: function() {
		var pg = jQuery('#page');
		return {h: pg.height(), w: pg.width()};
	},
	
	resize: function() {
		var size = this.getPageSize();
		this.container.width(size.w).height(size.h);
		
		var self = this;
		jQuery('img', this.container).each(function(i, img){
			var imgSize = self.calcImageSize( img );
			jQuery(img).width(imgSize.w).height(imgSize.h).css({
				top: imgSize.t,
				left: imgSize.l
			});
		});
	}
};
