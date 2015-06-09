var _AcaOpacity = 0.5;

var _AcaSelectedPercent = 72;
var _AcaNormalPercent;
var _AcaMinimumPercent;
var _AcaTime = 0.5;

var _FRONTINDEX = 1;
var _BACKINDEX = 0;

var _Academics = {
	_ListSection : [],
	_ListSectionLength : 0,
	_isExpanded : false,
	_PrevPosition : -1,
	_ListBackground : [],
	_BackgroundFront : 0,
	_BackgroundIndex : 0,
	_Timer : -1,
	_isInArticle : false,
	_isExpanding : false,

	Init : function(){
		//init section
		var Section = $('#academics section');
		this._ListSectionLength = Section.length;
		_AcaNormalPercent = 100 / this._ListSectionLength;
		_AcaMinimumPercent = (100 - _AcaSelectedPercent) / (this._ListSectionLength - 1);
		for (var i = 0; i < this._ListSectionLength; i++) {
			this._ListSection[i] = new AcademicsSection(Section[i], i);
		}
		//init background
		for (var i = 0; i < 2 ; i++){
			var Background = $('#academics .acabg' + (i + 1));
			this._ListBackground[i] = new AcademicsBackground(Background);
			if (i == this._BackgroundFront){
				this._ListBackground[i].SetBg(this._BackgroundIndex);
				this._ListBackground[i].SetZIndex(_FRONTINDEX);
			} else {
				this._ListBackground[i].SetZIndex(_BACKINDEX);
			}
		}
	},

	onWindowResize : function(){
		for (var i = 0; i < this._ListSectionLength; i++) {
			this._ListSection[i].Resize();
		}
		for (var i = 0; i < 2; i++) {
			this._ListBackground[i].Resize();
		}
	},

	Expand : function(position){
		if (this._isExpanded){
			if (this._PrevPosition == position) return;
			for (var i = 0; i < this._ListSectionLength; i++) {
				this._ListSection[i].HeightPercent = _AcaNormalPercent;
			}
			this._ListSection[this._PrevPosition].Veil();
			this._ListSection[this._PrevPosition].ChangeCursor(false);
			this._BackgroundIndex = this._PrevPosition;
			this.LoopBackground();
		} else {
			for (var i = 0; i < this._ListSectionLength; i++) {
				if (i == position){
					this._ListSection[i].HeightPercent = _AcaSelectedPercent;
				} else {
					this._ListSection[i].HeightPercent = _AcaMinimumPercent;
				}
			}
			this._ListSection[position].UnVeil();
			this._ListSection[position].ChangeCursor(true);
			this.EndLoopBackground();
			this.BackgroundAnimate(position);
		}

		var topPercent = 0;
		for (var i = 0; i < this._ListSectionLength; i++) {
			this._ListSection[i].TopPercent = topPercent;
			this._ListSection[i].Animate();
			topPercent += this._ListSection[i].HeightPercent;
		}

		this._isExpanding = true;
		if (this._isExpanded){
			setTimeout(function(){
				_Academics._isExpanding = false;
				_Academics.CheckVeil();
			}, _AcaTime * 1000);	
		}

		this._PrevPosition = position;
		this._isExpanded = !this._isExpanded;
	},

	Veil : function(position){
		if (this._isExpanded || !this._isInArticle || this._isExpanding) return;
		this._ListSection[position].Veil();
	},

	UnVeil : function(position){
		if (this._isExpanded || !this._isInArticle || this._isExpanding) return;
		this._ListSection[position].UnVeil();
	},

	CheckVeil : function(){
		for (var i = 0; i < this._ListSectionLength; i++) {
			if (this.CheckMouseInsideDiv(this._ListSection[i].Section))
				this._ListSection[i].UnVeil();
			else
				this._ListSection[i].Veil();
		}
	},

	CheckMouseInsideDiv : function(obj){
		var Top = $(obj).position().top;
		var Left = $(obj).position().left;
		var Height = $(obj).outerHeight(true);
		var Width = $(obj).outerWidth(true);
		var X = _MousePos.x;
		var Y = _MousePos.y - _WinHeight;
		return (X >= Left && X <= Left + Width && Y >= Top && Y <= Top + Height);
	},

	LoopBackground : function(){
		clearTimeout(_Academics._Timer);
		_Academics._Timer = setTimeout(function(){
			_Academics._BackgroundIndex++;
			_Academics._BackgroundIndex = _Academics._BackgroundIndex % _Academics._ListSectionLength;
			_Academics.BackgroundAnimate(_Academics._BackgroundIndex);
			_Academics.LoopBackground();
		}, 4000);
	},

	EndLoopBackground : function(){
		clearTimeout(this._Timer);
	}, 

	BackgroundAnimate : function(index){
		var BackgroundBack = 1 - this._BackgroundFront;

		this._ListBackground[BackgroundBack].SetBg(index);

		this._ListBackground[BackgroundBack].FadeIn();
		this._ListBackground[this._BackgroundFront].FadeOut();

		this._BackgroundFront = BackgroundBack;
	}, 

	OutArticle : function(){
		if (!this._isInArticle) return;
		this.EndLoopBackground();
		this._isInArticle = false;
		if (!this._isExpanded){
			for (var i = 0; i < this._ListSectionLength; i++) {
				if (!this._ListSection[i].isVeiled){
					this._ListSection[i].Veil();
				}
			}	
		}
		for (var i = 0; i < 2; i++) {
			if (this._ListBackground[i].Tween != null){
				this._ListBackground[i].Tween.kill();	
			}
		}
		this._ListBackground[this._BackgroundFront].SetZIndex(_FRONTINDEX);
		this._ListBackground[1 - this._BackgroundFront].SetZIndex(_BACKINDEX);
	},

	InArticle : function(){
		if (this._isInArticle) return;
		this.LoopBackground();
		if (!this._isExpanded){
			this.CheckVeil();	
		}
		this._isInArticle = true;
	}
}

var AcademicsSection = function(obj, position){
	this.position = position;
	this.Section = obj;
	this.Section.position = position;
	this.BGVeil = obj.children[0];
	this.BG = obj.children[1];
	this.BGImg = obj.children[1].children[0];
	this.Title = obj.children[2];
	this.Description = obj.children[3];
	this.TextIn = obj.children[4];
	this.TweenSection = null;
	this.TweenBGImg = null;
	this.TopPercent = 0;
	this.HeightPercent = 0;
	this.isVeiled = true;
	this.Init();
}

AcademicsSection.prototype.Init = function() {
	$(this.Section).attr("onclick", "_Academics.Expand("+ this.position +")");
	$(this.Section).attr("onmouseover", "_Academics.UnVeil("+ this.position +")");
	$(this.Section).attr("onmouseout", "_Academics.Veil("+ this.position +")");
	this.HeightPercent = _AcaNormalPercent;
	this.TopPercent = _AcaNormalPercent * this.position;

	$(this.BGVeil).css("opacity", _AcaOpacity);
	this.Grayscale(1);
	this.BGVeil.position = this.position;
}

AcademicsSection.prototype.Resize = function(){
	var Height = _WinInsideHeight * this.HeightPercent / 100;
	var Width = _WinWidth * 0.7;
	var Top = _WinInsideHeight * this.TopPercent / 100;
	var Left = _WinWidth * 0.15;

	$('#listsecbg').css("height", _WinInsideHeight);
	$('#listsecbg').css("width", Width);
	$('#listsecbg').css("left", Left);

	$(this.Section).css("height", Height);
	$(this.Section).css("width", Width);
	$(this.Section).css("top", Top);
	$(this.Section).css("left", Left);

	var TitleHeight = _WinInsideHeight * _AcaMinimumPercent / 100;
	$(this.Title).css("height", TitleHeight);
	$(this.Title).css("line-height", TitleHeight + 'px');

	var BgHeight = _WinInsideHeight * _AcaSelectedPercent / 100;
	$(this.BGImg).css("height", BgHeight);
	$(this.BGImg).css("width", Width);
	var ImgTop = this.position * TitleHeight - Top;
	$(this.BGImg).css("top", ImgTop);
}

AcademicsSection.prototype.Animate = function(){
	var Height = _WinInsideHeight * this.HeightPercent / 100;
	var Top = _WinInsideHeight * this.TopPercent / 100;
	if (this.TweenSection != null){this.TweenSection.kill();}
	this.TweenSection = TweenLite.to(this.Section, _AcaTime, {
		top: Top,
		height: Height,
		ease: "easeInOutCubic",
		onUpdate : function(obj, x){
			var top = $(this.target).position().top;
			$(obj).css("top", x - top);
		},
		onUpdateParams : [this.BGImg, this.position * _WinInsideHeight * _AcaMinimumPercent / 100]
	});
}

AcademicsSection.prototype.Veil = function(){
	if (this.isVeiled) return;
	$(this.BGVeil).css("opacity", _AcaOpacity);
	this.Grayscale(1);
	//this.ChangeCursor(false);
	this.isVeiled = true;
}

AcademicsSection.prototype.UnVeil = function(){
	if (!this.isVeiled) return;
	$(this.BGVeil).css("opacity", 0);
	this.Grayscale(0);
	//this.ChangeCursor(true);
	this.isVeiled = false;
}

AcademicsSection.prototype.Grayscale = function(value){
	$(this.BGImg).css({
		"-webkit-filter": "grayscale("+ value +")",
		"filter": "grayscale("+ value +")"
	});
}

AcademicsSection.prototype.ChangeCursor = function(isDefault){
	if (isDefault)
		$(this.Section).css("cursor", "default");
	else
		$(this.Section).css("cursor", "pointer");
}

var AcademicsBackground = function(obj){
	this.Background = obj;
	this.Init();
	this.Tween = null;
}

AcademicsBackground.prototype.Init = function(){

}

AcademicsBackground.prototype.Resize = function(){
	var bgWidth = _WinWidth * 0.15;
	var bgHeight = _WinInsideHeight;
	var bgSize = bgWidth + "px " + bgHeight + "px";
	$(this.Background).css("background-size", bgSize);
	$(this.Background).css("width", bgWidth);
	$(this.Background).css("height", bgHeight);
	$(this.Background[1]).css("left", _WinWidth * 0.85);
}

AcademicsBackground.prototype.FadeOut = function(){
	if (this.Tween != null){this.Tween.kill();}

	$(this.Background).css("opacity", 1);
	$(this.Background).css("z-index", _FRONTINDEX);
	
	this.Tween = TweenLite.to(this.Background, 1.5, {
		opacity: 0,
		ease: "easeInOutSine"
	});
}

AcademicsBackground.prototype.FadeIn = function(){
	if (this.Tween != null){this.Tween.kill();}

	$(this.Background).css("opacity", 1);
	$(this.Background).css("z-index", _BACKINDEX);
}

AcademicsBackground.prototype.SetZIndex = function(index){
	$(this.Background).css("z-index", index);
	if (index == _FRONTINDEX){
		$(this.Background).css("opacity", 1);
	} else {
		$(this.Background).css("opacity", 0);
	}
}

AcademicsBackground.prototype.SetBg = function(position){
	var url_left = "url('home_page/images/aca"+ (position+1) +"_left.jpg')";
	$(this.Background[0]).css("background-image", url_left);
	var url_right = "url('home_page/images/aca"+ (position+1) +"_right.jpg')";
	$(this.Background[1]).css("background-image", url_right);
}
