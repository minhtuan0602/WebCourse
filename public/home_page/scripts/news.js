
var _News = {
	_ListImage : [],
	_ListPoint : [],
	_ListImageLength : 0,
	_ImageFront : 0,
	_Timer : -1,
	_UserClicked : false,
	_isInArticle : true,
	_BGNews : null,
	_BtnNews : null,
	_BotNews : null,
	_BodyNews : null,
	_BoxNews : null,
	_LogoSizePercent : 10,
	_LogoPaddingPercent : 1,

	Init : function(){
		var Section = $("#listnewssec section");
		this._ListImageLength = Section.length;
		this.InitPoint();
		
		for (var i = 0; i < this._ListImageLength; i++) {
			this._ListImage[i] = new NewsImage(Section[i], this._ListPoint[i], i);
		}
		this._ListImage[this._ImageFront].PointImgShow();
		this.LoopAnimate();
		//bg
		var bg = document.getElementById("newstopbg")
		this._BGNews = new BackGroundImg( bg, 4, 1.5, "home_page/images/news", 5);
		this._BGNews.Loop();
		//cate
		_ListCate.Init("home_page/images/news", this._ListImageLength);
		//btn
		this._BtnNews = $("#newsbtn");
		$(this._BtnNews).attr("onclick", "_ListCate.Open()");
		//bottom
		this._BoxNews = $("#newsbox");
		this._BotNews = $("#newsbottom");
		this._BodyNews = $("#newsbody");
	},

	InitPoint : function(){
		var html = '<ul>';
		for (var i = 0; i < this._ListImageLength; i++) {
			html += '<li>' + '<div class="pointimg"></div>' + '</li>';
		}
		html += '</ul>';
		$("#listpoint").append(html);
		this._ListPoint = $('#listpoint ul li');
	},

	onWindowResize : function(){
		var Padding = _WinHeight * this._LogoPaddingPercent / 100;
		var Size = _WinHeight * this._LogoSizePercent / 100 - Padding * 2;
		var Left = (_WinWidth - Size) / 2;
		$('#newslogo').css("top", Padding);
		$('#newslogo').css("left", Left);
		$('#newslogo').css("height", Size);
		$('#newslogo').css("width", Size);

		var Top = _Nav._TopPercent * _WinHeight / 100 + 46;
		var Height = _WinHeight * 0.45;
		$("#listnewssec").css("top" , Top);
		$("#listnewssec").css("height" , Height);
		var PointTop = Top + Height - 30;
		$("#listpoint").css("top" , PointTop);

		for (var i = 0; i < this._ListImageLength; i++) {
			this._ListImage[i].Resize();
		}

		var NewsBottomHeight = _WinHeight - (Top + Height);
		$(this._BotNews).css("height", NewsBottomHeight);
		var NewsBoxTop = (NewsBottomHeight - $(this._BoxNews).outerHeight(true))/2;
		$(this._BoxNews).css("top", NewsBoxTop);
	},

	OnClick : function(event){
		var position = event.target.position;
		_News.Animate(position);
		_News._UserClicked = true;
	},

	Animate : function(position){
		position = position % this._ListImageLength;
		var Height = _WinHeight * 0.45;
		for (var i = 0; i < this._ListImageLength; i++) {
			var Top = (-i + position) * Height;
			this._ListImage[i].Animate(Top);
		}
		setTimeout(function(){
			for (var i = 0; i < _News._ListImageLength; i++) {
				if (i == _News._ImageFront)
					_News._ListImage[i].PointImgShow();
				else
					_News._ListImage[i].PointImgHide();
			}
		}, 100);
		this._ImageFront = position;
	},

	LoopAnimate : function(){
		clearTimeout(_News._Timer);
		_News._Timer = setTimeout(function(){
			if (_News._UserClicked) {
				_News._UserClicked = false;
				_News.LoopAnimate();
			} else {
				var pos = (_News._ImageFront + 1) % _News._ListImageLength;
				_News.Animate(pos);
				_News.LoopAnimate();	
			}
		}, 4000);
	},

	EndLoopAnimate : function(){
		clearTimeout(_News._Timer);
	},

	InArticle : function(){
		if (this._isInArticle) return;
		this.LoopAnimate();
		this._isInArticle = true;
		this._BGNews.Loop();
	},

	OutArticle : function(){
		if (!this._isInArticle) return;
		this.EndLoopAnimate();
		this._isInArticle = false;
		this._BGNews.EndLoop();
	}
}

var NewsImage = function(obj, point, position){
	this.Img = obj;
	this.Point = point;
	this.PointImg = point.children[0];
	this.position = position;
	this.Tween = null;
	this.Init();
}

NewsImage.prototype.Init = function(){
	this.PointImgHide();
	this.Point.position = this.position;
	this.PointImg.position = this.position;
	this.Point.addEventListener("click", _News.OnClick, false);
}

NewsImage.prototype.Resize = function(){
	var Height = _WinHeight * 0.45;
	$(this.Img).css("top", Height * (- this.position + _News._ImageFront));
}

NewsImage.prototype.PointImgShow = function(){
	$(this.PointImg).show();
	$(this.Point).css("cursor", "default");
}

NewsImage.prototype.PointImgHide = function(){
	$(this.PointImg).hide();
	$(this.Point).css("cursor", "pointer");
}

NewsImage.prototype.Animate = function(Top){
	if (this.Tween != null){this.Tween.kill();}
	this.Tween = TweenLite.to(this.Img, 1.2, {
		top: Top,
		ease: "easeInOutCubic"
	});
}

var _ListCate = {
	_Obj : null,
	_ImgLength : 0,
	_Tween : null,
	_isHide : true,
	_Time : 1.2,
	_ArtTime : 1.2,
	_ListLi : [],
	_ListLiLength : 0,
	_CloseBtn : null,
	_Art : null,

	Init : function(url, length){
		this._Obj = document.getElementById("listcate");
		this._Art = $("#art");
		$(this._Obj).hide();
		$(this._Obj).css("top", "-100%");
		this.InitUl(_CATEDATA, _CATEID);
		this._CloseBtn = $("#btnclose");
		$(this._CloseBtn).css("height" ,_NAVBARHEIGHT);
		$(this._CloseBtn).attr("onclick", "_ListCate.BtnClose()");
	},

	BtnClose : function(){
		if (_State == _LISTCATESTATE){
			_ListCate.Close();
		} else if (_State == _ARTICLESTATE){
			_ListCate.HideArt();
		}
	},

	InitUl : function(data, dataid){
		var html = '<ul>';
		for (var i = 0; i < data.length; i++) {
			html += '<li>' + data[i] + '</li>';
		}
		html += '</ul>';
		$("#listcateul").append(html);

		this._ListLi = $('#listcateul ul li');
		this._ListLiLength = this._ListLi.length;
		for (var i = 0; i < this._ListLiLength; i++) {
			this._ListLi[i].addEventListener("click", _ListCate.Click, false);
			this._ListLi[i].position = dataid[i];
		}
	},

	onWindowResize : function(){
		var CateHeight = (_WinHeight - _NAVBARHEIGHT) / this._ListLiLength;
		$(this._ListLi).css("height", CateHeight);
		$(this._ListLi).css("line-height", CateHeight + "px");

		var fontsize = 27;
		if (_WinHeight > 667){
			fontsize = Math.floor(27 + 0.0577 * (_WinHeight - 667));
		}
		$(this._ListLi).css("font-size", fontsize + "px");

		if (_State != _NORMALSTATE){
			$('#navbar').css("top", _WinHeight * _Nav._TopPercent / 100 + _WinHeight);
		}
	},

	Click : function(event){
		_ListCate.GetCategory(event.target.position);
		_ListCate.ShowArt();
	},

	Open : function(){
		$(document).scrollTop(0);
		_State = _LISTCATESTATE;
		_News.EndLoopAnimate();

		this._isHide = false;
		$("body").addClass("stopscroll");
		$(this._Obj).show();
		this.Animate(0);
		this.AnimateNewsBody("100%");
		this.AnimateNavBar(true);
	},

	Close : function(){
		$(document).scrollTop(0);
		_State = _NORMALSTATE;
		this._isHide = true;		
		$("body").removeClass("stopscroll");
		this.Animate("-100%");

		$(_News._BodyNews).show();
		this.AnimateNewsBody(0);
		this.AnimateNavBar(false);
	},

	Animate : function(Top){
		if (this._Tween != null){this._Tween.kill();}
		_News._BGNews.Pause();
		this._Tween = TweenLite.to(this._Obj, this._Time, {
			top: Top,
			ease: "easeInOutCubic",
			onComplete: function(){
				if (this._isHide){
					$(this._Obj).hide();
				}
				_News._BGNews.Resume();
			},
			onCompleteScope : this
		});
	},

	AnimateNewsBody : function(Top){
		TweenLite.killTweensOf(_News._BodyNews);
		TweenLite.to(_News._BodyNews, this._Time, {
			top: Top,
			ease: "easeInOutCubic",
			onComplete: function(){
				if (!this._isHide){
					$(_News._BodyNews).hide();
				} else {
					_News.LoopAnimate();
				}
			},
			onCompleteScope : this
		});
	},

	AnimateNavBar : function(isHide){
		var Nav = $('#navbar');
		var TopNav = _WinHeight * _Nav._TopPercent / 100;
		var Top;
		if (isHide){
			Top = TopNav + _WinHeight;
		} else {
			Top = TopNav;
		}
		TweenLite.killTweensOf(Nav);
		TweenLite.to(Nav, this._Time, {
			top: Top,
			ease: "easeInOutCubic"
		});
	},

	ShowArt : function(position){
		_State = _ARTICLESTATE;
		$(this._Art).show();
		_News._BGNews.Pause();
		TweenLite.killTweensOf(this._ListLi);
		TweenLite.to(this._ListLi, this._ArtTime, {
			opacity: 0,
			ease: "easeInOutCubic",
			onComplete: function(){
				$(this._ListLi).hide();
			},
			onCompleteScope : this
		});

		TweenLite.killTweensOf(this._Art);
		TweenLite.to(this._Art, this._ArtTime, {
			top: "30%",
			ease: "easeInOutCubic",
			onComplete: function(){
				_News._BGNews.Resume();
			},
			onCompleteScope : this
		});
	},

	HideArt : function(){
		_State = _LISTCATESTATE;
		this._ListLi.show();
		_News._BGNews.Pause();
		TweenLite.killTweensOf(this._ListLi);
		TweenLite.to(this._ListLi, this._ArtTime, {
			opacity: 1,
			ease: "easeInOutCubic",
			onComplete: function(){
				_News._BGNews.Resume();	
			},
			onCompleteScope : this
		});

		TweenLite.killTweensOf(this._Art);
		TweenLite.to(this._Art, this._ArtTime, {
			top: "100%",
			ease: "easeInOutCubic",
			onComplete: function(){
				$(this._Art).hide();
			},
			onCompleteScope : this
		});	
	}, 

	GetArticle : function(idart){
		this.CallServer("get-article", {id: idart}, function(Data){
			console.log(Data);
			$(_ListCate._Art.children()[0]).html(Data.title);
			$(_ListCate._Art.children()[1]).html(Data.body);
		});
	},

	GetCategory : function(idcate){
		if (idcate == -1 || idcate == "-1") return;
		this.CallServer("get-category", {id: idcate}, function(Data){
			console.log(Data);
			var html = '<div class="listart">';
			for (var i = 0; i < Data.body.length; i++) {
				html += '<a>' + Data.body[i].title + '</a>';
			}
			html += '</div>';
			$(_ListCate._Art.children()[0]).html(Data.title);
			$(_ListCate._Art.children()[1]).html(html);

			var listart = $(".listart a");
			for (var i = 0; i < Data.body.length; i++) {
				$(listart[i]).attr("onclick", "_ListCate.GetArticle(" + Data.body[i].id + ")");
			}
		});
	},

	CallServer : function(host, obj, callback){
		$.get( "http://localhost:8000/" + host, obj ,function(result) {
			callback(JSON.parse(result));
		});
	}
};


var BackGroundImg = function(obj, time, fadetime, url, length){
	this.Obj = obj;
	this.Length = length;
	this.Url = url;
	this.BG = [];
	
	this.Time = time;
	this.FadeTime = fadetime;
	this.Tween = null;
	this.TweenBG = [];
	this.Index = 0;
	this.IndexPrev = -1;
	this.BackZindex = _BACKINDEX;
	this.FrontZindex = _FRONTINDEX;

	this.InitBG();
}

BackGroundImg.prototype.InitBG = function() {
	for (var i = 0; i < this.Length; i++) {
		this.BG[i] = CreateDiv(this.Obj, "newsbg");	
		$(this.BG[i]).css("background-image", this.GetImgUrl(i));
		if (i != this.Index){
			$(this.BG[i]).css("opacity", 0);
			$(this.BG[i]).css("z-index", this.FrontZindex);
		} else {
			$(this.BG[i]).css("z-index", this.BackZindex);
		}
	}
}


BackGroundImg.prototype.SetZindex = function(backzindex, frontzindex){
	this.BackZindex = backzindex;
	this.FrontZindex = frontzindex;
}

BackGroundImg.prototype.GetImgUrl = function(position){
	return "url('" + this.Url + (position + 1) + ".jpg')";
}

BackGroundImg.prototype.Loop = function(){
	if (this.Tween != null) this.Tween.kill();
	this.Tween = TweenLite.to(this.Obj, this.Time,{
		onComplete : function(){
			this.IndexPrev = this.Index;
			this.Index++;
			this.Index = this.Index % this.Length;
			this.Animate();
			this.Loop();
		},
		onCompleteScope : this
	});
}

BackGroundImg.prototype.EndLoop = function(){
	this.Tween.kill();
}

BackGroundImg.prototype.Animate = function(){
	for (var i = 0; i < this.Length; i++) {
		if (i == this.Index){
			$(this.BG[i]).css("opacity", 0);
			$(this.BG[i]).css("z-index", this.FrontZindex);	
		} else if (i == this.IndexPrev){
			$(this.BG[i]).css("opacity", 1);
			$(this.BG[i]).css("z-index", this.BackZindex);	
		} else {
			$(this.BG[i]).css("opacity", 0);
			$(this.BG[i]).css("z-index", this.BackZindex);	
		}
	};
	
	this.FadeIn();
}

BackGroundImg.prototype.FadeIn = function(){
	this.TweenBG[this.Index] = TweenLite.to(this.BG[this.Index], this.FadeTime, {
		opacity: 1,
		ease: "easeInOutSine",
		onComplete : function() {
			$(this.BG[this.IndexPrev]).css("opacity", 0);		
		},
		onCompleteScope: this
	});
}

BackGroundImg.prototype.Pause = function(){
	if (this.Tween != null) this.Tween.pause();
	for (var i = 0; i < this.Length; i++) {
		if (this.TweenBG[i] != null) 
			this.TweenBG[i].pause();	
	}
}

BackGroundImg.prototype.Resume = function(){
	if (this.Tween != null) this.Tween.resume();
	for (var i = 0; i < this.Length; i++) {
		if (this.TweenBG[i] != null) 
			this.TweenBG[i].resume();	
	}
}
