var _Scrolling = false;
var _Position = 0;
var _State;
var _NORMALSTATE = 0;
var _LISTCATESTATE = 1;
var _ARTICLESTATE = 2;
var _FOOTERSTATE = 3;

function preventDefault(e){
	e = e || window.event;
	if (e.preventDefault)
		e.preventDefault();
	e.returnValue = false;  
}

function WindowScroll(){
	if (_State == _NORMALSTATE){
		_Nav.RePosition();	
	}
}

function MouseScroll(event) {
	preventDefault(event);
	var delta;
	if ('wheelDelta' in event) {
		delta = event.wheelDelta;
	} else {
		delta = -40 * event.detail;
	}
	//console.log(delta);
	if (_About._BoxTextIn.inside){
		_About.onScrollInText(delta);
		return;
	}

	if (_State == _NORMALSTATE){
		if (!_Scrolling && _Position == 3 && delta < 0){
			_State = _FOOTERSTATE;
			_Footer.Show();
		} else {
			ScrollNormal(delta);	
		}
	} else if (_State == _ARTICLESTATE){
 		ScrollArticle(delta);
	} else if (_State == _FOOTERSTATE){
		ScrollFooter(delta);
	}
}

var _FooterTimer;
function ScrollFooter(delta){
	if (delta > 0){
		_Footer.Hide();
		clearTimeout(_FooterTimer);
		_FooterTimer = setTimeout(function(){ _State = _NORMALSTATE; }, 200);
	}
}

function ScrollArticle(delta){
	var Height = $(_ListCate._Art).outerHeight(true);
	var Top = $(_ListCate._Art).position().top;
	console.log(Height +":"+ _WinHeight*0.7);
	if (Top + delta <= _WinHeight - Height){
		$(_ListCate._Art).css("top", _WinHeight - Height);	
	} else if (Top + delta >= _WinHeight * 0.3){
		$(_ListCate._Art).css("top", _WinHeight * 0.3);	
	} else{
		$(_ListCate._Art).css("top", Top + delta);	
	}
}

function ScrollNormal (delta){
	if (_Scrolling || delta == 0) return;
	_Scrolling = true;
	var Top = $(document).scrollTop();
	var position = Math.floor(Top / (_WinInsideHeight));
	var inMiddle = (Top % (_WinInsideHeight)) != 0;

	if (inMiddle){
		if (delta < 0) position += 1;
	} else {
		if (delta < 0) position += 1;
		else position -= 1;	
	}

	if (position >= 0 && position < _Articles.Length){
		_News.OutArticle();
		_Academics.OutArticle();

		TweenLite.to(window, 1, {
			scrollTo:{ y:_WinInsideHeight * position }, 
			ease: "easeInOutCubic",
			immediateRender: true,
			onComplete : function(){
				_Scrolling = false;
				_Position = position;
				if (_Position == 0){
					_News.InArticle();	
				} else if  (_Position == 1){
					_Academics.InArticle();	
				}
			}
		});
	} else {
		_Scrolling = false;
	}
}

function ScrollToPosition(event){
	var position = event.target.position;
	if (position >= 0 && position < _Articles.Length){
		_News.OutArticle();
		_Academics.OutArticle();

		_Scrolling = false;
		TweenLite.to(window, 1, {
			scrollTo:{ y: _WinInsideHeight * position }, 
			ease: "easeInOutCubic",
			onComplete : function(){
				_Position = position;
				if (_Position == 0){
					_News.InArticle();	
				} else if  (_Position == 1){
					_Academics.InArticle();	
				}
			}
		});
	}
}

var _Footer = {
	_Obj : null,
	_isExpanded : false,
	_ExpandTime : 0.5,

	Init : function(){
		this._Obj = $("#footer");
		$(this._Obj).hide();
	},

	onWindowResize : function(){
		if (this._isExpanded){
			$(this._Obj).css("bottom", 0);
		} else {
			$(this._Obj).css("bottom", -_FOOTERHEIGHT);
		}
	},

	Show : function(){
		if (this._isExpanded) return;
		$(this._Obj).show();
		TweenLite.killTweensOf(this._Obj);
		TweenLite.to(this._Obj, this._ExpandTime, {
			bottom : 0, 
			ease: "easeInOutCubic"
		});
		this._isExpanded = true;
	},

	Hide : function(){
		if (!this._isExpanded) return;
		TweenLite.killTweensOf(this._Obj);
		TweenLite.to(this._Obj, this._ExpandTime, {
			bottom : -_FOOTERHEIGHT, 
			ease: "easeInOutCubic",
			onComplete : function(){
				$(this._Obj).hide();
			},
			onCompleteScope : this
		});
		this._isExpanded = false;
	}
}