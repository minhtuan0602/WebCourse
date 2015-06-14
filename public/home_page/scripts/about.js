
var _AboutLogoHeightPercent = 20;
var _AboutLogoMinWidthPercent = 50;
var _AboutLogoUpPercent = 7;
var _AboutTextWidthPercent = 40;
var _AboutLineDownPercent = 10;
var _AboutTitleDownPercent = 14;
var _AboutLineWidth = 150;
var _AboutBtnWidthPercent = 15;
var _AboutExpandTime = 0.3;

var _About = {
	_Logo : null,
	_Text : null,
	_TextIn : [],
	_Title : [],
	_AboutHead : null,
	_Line : null,
	_LineLogo : null,
	_Btn : [],
	_Length : 0,
	_Selected : 0,
	_TopTextIn : 0,
	_BoxTextIn : {},

	Init : function(){
		this._Logo = $('#logo');
		this._Text = $('#textabout');
		this._TextIn = $('#textabout .intextabout');
		this._Title = $('#abouthead .titleabout');
		this._AboutHead = $('#abouthead');
		this._Line = $('#aboutline');
		this._LineLogo = $('#aboutlinelogo');
		this._Length = this._Title.length;

		for (var i = 0; i < this._Length; i++) {
			$(this._Title[i]).html($(this._Title[i]).html().toUpperCase());
			this._Btn[i] = new Btn(this._Title[i]);
			$(this._Title[i]).attr("onmouseover", "_About.BtnOver("+ i +")");
			$(this._Title[i]).attr("onmouseout", "_About.BtnOut("+ i +")");
			$(this._Title[i]).attr("onclick", "_About.BtnOpen("+ i +")");
			if (i != this._Selected){
				this._Btn[i].RemoveBorder();
				$(this._TextIn[i]).css("z-index", 0);
				
			} else {
				this._Btn[i].ChangeCursor(true);
				$(this._TextIn[i]).css("z-index", 1);
			}
			if (i != this._Length - 1)
				this._Btn[i].AddLine();
		}
		this._BoxTextIn.inside = false;
	},

	onScrollInText : function(delta){
		this._TopTextIn += delta;
		var maxtop = -($(this._TextIn[this._Selected]).outerHeight(true) - this._BoxTextIn.height);
		if (this._TopTextIn < maxtop){
		 	$(this._TextIn[this._Selected]).css("top", maxtop);
		 	this._TopTextIn = maxtop;
		} else if (this._TopTextIn > 0){
			$(this._TextIn[this._Selected]).css("top", 0);
			this._TopTextIn = 0;
		} else {
			$(this._TextIn[this._Selected]).css("top", this._TopTextIn);
		}
	},

	onMouseMove : function(x, y){
		y = y - this._BoxTextIn.ptop;
		if (x >= this._BoxTextIn.left && x <= this._BoxTextIn.left + this._BoxTextIn.width
			&& y >= this._BoxTextIn.top && y <= this._BoxTextIn.top + this._BoxTextIn.height){
			this._BoxTextIn.inside = true;
		} else {
			this._BoxTextIn.inside = false;
		}
	},

	onWindowResize : function(){
		this.Animate(true);

		var PWidth = $('#abouthead').width();
		var Width = Math.floor(_AboutBtnWidthPercent / 100 * PWidth);
		var Left = Math.floor((PWidth - Width * this._Length) / 2);
		for (var i = 0; i < this._Length; i++) {
			this._Btn[i].Resize(Left + (Width - 1)* i, Width);
		}

		this._BoxTextIn.ptop = $("#about").position().top;
		this._BoxTextIn.height = $(this._Text).outerHeight(true);
		this._BoxTextIn.width = $(this._Text).outerWidth(true);
		this._BoxTextIn.top = $(this._Text).position().top;
		this._BoxTextIn.left = $(this._Text).position().left;
	},

	BtnOver : function(position){
		if (this._Selected == position) return;
		this._Btn[position].Over();
	},

	BtnOut : function(position){
		if (this._Selected == position) return;
		this._Btn[position].Out();
	},

	BtnOpen : function(position){
		if (this._Selected == position) return;
		var temp = this._Selected;
		$(this._Title[this._Selected]).css("cursor", "pointer");
		$(this._Title[position]).css("cursor", "default");

		$(this._TextIn[this._Selected]).hide();
		$(this._TextIn[position]).css("top", 0);

		$(this._TextIn[position]).css("z-index", 1);
		$(this._TextIn[this._Selected]).css("z-index", 0);

		this._TopTextIn = 0;
		$(this._TextIn[position]).show();

		this._Selected = position;
		this.Animate(false);
		this._Btn[temp].Out();
	},

	OpenProfile : function(id){
		
	},

	Animate : function(im){
		var Size = Math.min(_WinInsideHeight * _AboutLogoHeightPercent / 100, _WinWidth * _AboutLogoMinWidthPercent / 100);
		var SizePercent = Size / _WinInsideHeight * 100;
		var TextHeightPercent = Math.min($(this._TextIn[this._Selected]).outerHeight(true) / _WinInsideHeight * 100 , 40);
		var TopLogoPercent = (100 - TextHeightPercent) / 2 - SizePercent - _AboutLogoUpPercent;
		var TopLogo = TopLogoPercent * _WinInsideHeight / 100;
		var LeftLogo = (_WinWidth - Size) / 2;

		if (im){
			$(this._Logo).css({height: Size, width: Size, top: TopLogo, left: LeftLogo});
		} else {
			TweenLite.killTweensOf(this._Logo);
			TweenLite.to(this._Logo, _AboutExpandTime,{
				ease : "easeInOutSine",
				top: TopLogo,
				left: LeftLogo
			});
		}
		

		var TextWidth = _AboutTextWidthPercent / 100 * _WinWidth;
		var TextHeight = TextHeightPercent / 100 * _WinInsideHeight;
		var TextLeft = (_WinWidth - TextWidth) / 2;
		var TextTop = (_WinInsideHeight - TextHeight) / 2;

		if (im){
			$(this._Text).css({height: TextHeight, top: TextTop, left: TextLeft});
		} else {
			TweenLite.killTweensOf(this._Text);
			TweenLite.to(this._Text, _AboutExpandTime,{
				ease : "easeInOutSine",
				height: TextHeight,
				top: TextTop,
				left: TextLeft
			});
		}
		
		//TitleHead
		var TitleHeadTop = TextTop + TextHeight + _AboutTitleDownPercent / 100 * _WinInsideHeight ;

		if (im){
			$(this._AboutHead).css({top: TitleHeadTop});
		} else {
			TweenLite.killTweensOf(this._AboutHead);
			TweenLite.to(this._AboutHead, _AboutExpandTime,{
				ease : "easeInOutSine",
				top: TitleHeadTop
			});
		}
		
		//TextIn
		if (im){
			$(this._TextIn[this._Selected]).css({opacity: 1});		
		} else {
			TweenLite.killTweensOf(this._TextIn[this._Selected]);
			$(this._TextIn[this._Selected]).css({opacity: 0});
			TweenLite.to(this._TextIn[this._Selected], _AboutExpandTime,{
				ease : "easeInOutSine",
				opacity: 1
			});		
		}

		//Line
		var LineTop =  TextTop + TextHeight + _AboutLineDownPercent / 100 * _WinInsideHeight ;
		var LineLeft = (_WinWidth - _AboutLineWidth) / 2;
		var LineLogoLeft = LineLeft + _AboutLineWidth / 2 - 5;
		if (im){
			$(this._Line).css({top: LineTop, left: LineLeft});
			$(this._LineLogo).css({top: LineTop - 5, left: LineLogoLeft});	
		} else {
			TweenLite.killTweensOf(this._Line);
			TweenLite.to(this._Line, _AboutExpandTime,{
				ease : "easeInOutSine",
				top: LineTop,
				left: LineLeft
			});
			TweenLite.killTweensOf(this._LineLogo);
			TweenLite.to(this._LineLogo, _AboutExpandTime,{
				ease : "easeInOutSine",
				top: LineTop - 5, 
				left: LineLogoLeft
			});
		}
	}
}