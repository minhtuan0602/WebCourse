
$( document ).ready(function() {
	$(document).scrollTop(0);
	_State = _NORMALSTATE;
	_Articles.Init();
	_Academics.Init();
	_News.Init();
	_Research.Init();
	_About.Init();
	_Footer.Init();
	
	WindowResize();
	WindowResize();
	$(window).resize(WindowResize);
	document.addEventListener("scroll", WindowScroll);
	document.addEventListener("mousewheel", MouseScroll, false);
	document.addEventListener ("DOMMouseScroll", MouseScroll, false);
	_Nav.Init(_NAVDATA);
});

var _MousePos = { x: -1, y: -1 };
$(document).mousemove(function(event) {
	_MousePos.x = event.pageX;
	_MousePos.y = event.pageY;
	_About.onMouseMove(_MousePos.x, _MousePos.y);
});

$(document).keydown(function(objEvent) {
    if (objEvent.keyCode == 9) {  //tab pressed
        objEvent.preventDefault(); // stops its action
    }
})

var _WinHeight, _WinWidth, _WinInsideHeight;
var _NAVBARHEIGHT = 46;
var _FOOTERHEIGHT = 150;

function WindowResize(){
	_WinHeight = $(window).height();
	_WinWidth = $(window).width();
	_WinInsideHeight = _WinHeight - _NAVBARHEIGHT;
	_Articles.onWindowResize();
	if (_State == _NORMALSTATE){
		_Nav.onWindowResize();	
	}
	_Academics.onWindowResize();
	_News.onWindowResize();
	_Research.onWindowResize();
	_About.onWindowResize();
	_ListCate.onWindowResize();
	_Footer.onWindowResize();
	$(document).scrollTop(_WinInsideHeight * _Position);
}

var _Articles = {
	Elem : null,
	Length : 0,

	Init : function(){
		this.Elem = $("article");
		this.Length = this.Elem.length;
	},

	onWindowResize : function(){
		for (var i = 0; i < this.Length; i++) {
			if (i == 0){
				$(this.Elem[i]).css("height", _WinHeight);
			} else {
				$(this.Elem[i]).css("height", _WinInsideHeight);
			}
		}	
	}
};