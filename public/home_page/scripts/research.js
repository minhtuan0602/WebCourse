var _BtnTime = 0.3;
var _TextTime = 0.3;
var _BtnWidthPercent = 34;
var _GroupPrefix = "SG";
var _ExpandTime = 0.5;
var _BarTime = 0.5;

var _Research = {
	_ListGroup : [],
	_ListGroupLength : 0,
	_GroupSelected : 0,
	_TitleHeight : 0,
	_Bn : 3,

	Init : function(){
		var GroupHead = $('#researchgroup .titlegroup');
		this._SCircle = document.getElementById('scircleresearch');
		this._ListGroupLength = GroupHead.length;
		for (var i = 0; i < this._ListGroupLength; i++) {
			this._ListGroup[i] = new ResearchGroup(GroupHead[i], i);
			if (i != this._GroupSelected){
				this._ListGroup[i].Hide();
				this._ListGroup[i].Head.RemoveBorder();
			} else {
				this._ListGroup[i].Head.ChangeCursor(true);
			}
		}
		this._TitleHeight = this._ListGroup[0].ListSection[0].GetTitleHeight();

		ResearchBar.Init();
	},

	onWindowResize : function(){
		ResearchBar.LeftHeight = $('#leftresearch').outerHeight(true);
		ResearchBar.OuterHeight = this._TitleHeight / 2 + $('#researchgroup').outerHeight(true);

		var PWidth = $('#researchgroup').width();
		var Width = Math.floor(_BtnWidthPercent / 100 * PWidth);
		var Left = Math.floor((PWidth - Width * this._ListGroupLength) / 2);
		for (var i = 0; i < this._ListGroupLength; i++) {
			this._ListGroup[i].Resize(Left + (Width - 1)* i, Width);
		}
		this._ListGroup[this._GroupSelected].AnimateShow(true);
		ResearchBar.Resize();
	},

	GroupOver : function(position){
		if (this._GroupSelected == position) return;
		this._ListGroup[position].Head.Over();
	},

	GroupOut : function(position){
		if (this._GroupSelected == position) return;
		this._ListGroup[position].Head.Out();
	},

	GroupOpen : function(position){
		if (this._GroupSelected == position) return;
		_ResearchQueue._Queue = [];
		var PrevGroup = this._GroupSelected;
		this._ListGroup[PrevGroup].Head.ChangeCursor(false);
		this._ListGroup[position].Head.ChangeCursor(true);
		this._ListGroup[PrevGroup].Hide();
		this._ListGroup[position].Show();
		this._ListGroup[position].AnimateShow(false);
		this._GroupSelected = position;
		this._ListGroup[PrevGroup].Head.Out();

		ResearchBar.Show();
	},

	ExpandSection : function(group, position){
		_ResearchQueue.Push(group, position);
	},

	ExpandSectionExe : function(group, position){
		this._ListGroup[group].ExpandSection(position)
	}
};

///////////////////////////////////////////////////////////////////
var ResearchGroup = function(head, position){
	this.Head = new Btn(head);
	this.GroupId = position;
	this.ListSection = [];
	this.ListSectionLength = 0;

	$(head).attr("onmouseover", "_Research.GroupOver("+ position +")");
	$(head).attr("onmouseout", "_Research.GroupOut("+ position +")");
	$(head).attr("onclick", "_Research.GroupOpen("+ position +")");

	this.Init();
};

ResearchGroup.prototype.Init = function(){
	this.GroupName = " ." + _GroupPrefix + this.GroupId;
	this.SectionSelected = -1;
	var Section = $('#research' + this.GroupName);
	this.ListSectionLength = Section.length;
	for (var i =0; i< this.ListSectionLength;i++){
		this.ListSection[i] = new ResearchSection(this.GroupId, Section[i], i);
	}
}

ResearchGroup.prototype.Hide = function(){
	$('#scircleresearch' + this.GroupName).hide();
	$('#research' + this.GroupName).hide();
}

ResearchGroup.prototype.Show = function(){
	$('#scircleresearch' + this.GroupName).css("opacity", 0);
	$('#scircleresearch' + this.GroupName).show();
	$('#research' + this.GroupName).show();
}

ResearchGroup.prototype.ExpandSection = function(position){
	if (position == this.SectionSelected) {
		_ResearchQueue.Pop(this.GroupId);
		return;
	}

	if (this.SectionSelected != -1)
		this.ListSection[this.SectionSelected].ChangeCursor(false);
	if (position != - 1)
		this.ListSection[position].ChangeCursor(true);

	var top = 0;
	_ResearchQueue.Init(this.GroupId);
	for (var section = 0; section < this.ListSectionLength; section++) {
		this.ListSection[section].Top = top;
		top += _Research._TitleHeight;
		if (section == position){
			top += this.ListSection[section].GetTextHeight();
			this.ListSection[section].Animate(true);
		} else {
			this.ListSection[section].Animate(false);
		}
	}
	ResearchBar.ContentHeight = top;
	ResearchBar.Change();
	this.AnimateDotExpand(position);

	this.SectionSelected = position;
}

ResearchGroup.prototype.AnimateDotExpand = function(position){
	for (var section = 0; section < this.ListSectionLength; section++) {
		var Top = this.ListSection[section].Top + _Research._TitleHeight / 2 + $('#researchgroup').outerHeight(true);
		var Left = $('#leftresearch').outerWidth(true);
		var Type;
		if (section == position)
			Type = 0;
		else if (section == this.SectionSelected)
			Type = 1;
		else
			Type = 2;
		this.ListSection[section].Dot.Reposition(Top, Left, Type);
	}
}

ResearchGroup.prototype.Resize = function(hleft, hwidth){
	this.Head.Resize(hleft, hwidth);
}

ResearchGroup.prototype.AnimateShow = function(im){
	var Top = 0;
	var LeftDot = $('#leftresearch').outerWidth(true);
	var TopBnDot = _Research._TitleHeight / 2 + $('#researchgroup').outerHeight(true);
	for (var i = 0; i < this.ListSectionLength; i++) {
		//Repos ngay lap tuc dot
		this.ListSection[i].Dot.RepositionIm(Top + TopBnDot, LeftDot, i == this.SectionSelected);

		$(this.ListSection[i].Section).css("top", Top);
		this.ListSection[i].Top = Top;

		Top += _Research._TitleHeight;
		if (!im) this.ListSection[i].ShowTitle();
		if (this.SectionSelected == i){
			Top += this.ListSection[i].GetTextHeight();
			if (!im) this.ListSection[i].ShowText();
		}		
	}
	ResearchBar.ContentHeight = Top;
}

///////////////////////////////////////////////////////////////////
var ResearchSection = function(grouppos, obj, position){
	this.GroupPosition = grouppos;
	this.position = position;
	this.Section = obj;
	this.Title = obj.children[0];
	this.Txt = obj.children[1];
	this.Dot = new ResearchDot(grouppos); 
	this.Top = 0;
	this.Init();
}

ResearchSection.prototype.Init = function(){
	$(this.Section).attr("onclick", 
		"_Research.ExpandSection("+ this.GroupPosition +", "+ this.position +")");
}

ResearchSection.prototype.ShowTitle = function(){
	$(this.Title).css("opacity", 0);
	TweenLite.killTweensOf(this.Title);
	TweenLite.to(this.Title, _TextTime, {opacity: 1, ease: "easeInOutSine"});
}

ResearchSection.prototype.ShowText = function(){
	$(this.Txt).css("opacity", 0);
	TweenLite.killTweensOf(this.Txt);
	TweenLite.to(this.Txt, _TextTime, {opacity: 1, ease: "easeInOutSine"});
}

ResearchSection.prototype.GetTextHeight = function(){
	return $(this.Txt).outerHeight(true);
}

ResearchSection.prototype.GetTitleHeight = function(){
	return $(this.Title).outerHeight(true);
}

ResearchSection.prototype.ChangeCursor = function(isDefault){
	if (isDefault){
		$(this.Title).addClass("retitleselected");
		$(this.Title).css("cursor", "default");	
	} else {
		$(this.Title).removeClass("retitleselected");
		$(this.Title).css("cursor", "pointer");	
	}
}

ResearchSection.prototype.Animate = function(expand){
	var hidden;
	var Height;
	if (expand){
		Height = this.GetTextHeight();
		//console.log(Height);
		$(this.Txt).css("height", 0);
		$(this.Txt).css("visibility","visible");
		hidden = false;
	} else {
		Height = 0;
		hidden = true;
	}
	TweenLite.to(this.Txt, _ExpandTime, {
		height: Height, 
		ease: "easeInOutSine",
		onComplete : function(group, position, hidden){
			if (hidden)
				$(this.target).css("visibility","hidden");
			$(this.target).css("height","auto");
			_ResearchQueue.Sum(group, position);
		},
		onCompleteParams : [this.GroupPosition, this.position, hidden]
	});

	TweenLite.to(this.Section, _ExpandTime, {
		top: this.Top, 
		ease: "easeInOutSine",
		onComplete : function(group, position){
			_ResearchQueue.Sum(group, position);
		},
		onCompleteParams : [this.GroupPosition, this.position]
	});
}

///////////////////////////////////////////////////////////////////
var ResearchBar = {
	ContentHeight : 0,
	OuterHeight : 0,
	LeftHeight : 0,
	NextSection : 0,

	Init : function(){
		this.Bar = $('#leftresearchbar');
		var LeftDiv = document.getElementById('leftresearch');
		this.TopCircle = CreateDiv(LeftDiv, "bigcircle");
		this.BotCircle = CreateDiv(LeftDiv, "bigcircle");

		$(this.BotCircle).css("top", -7);
		$(this.TopCircle).css("top", -7);
	},

	Resize : function(){
		TweenLite.killTweensOf(this.Bar);
		TweenLite.killTweensOf(this.BotCircle);
		$(this.BotCircle).css("top", this.GetHeightBar() - 7);
		$(this.Bar).css("height", this.GetHeightBar());
	},

	Show : function(){
		TweenLite.killTweensOf(this.Bar);
		TweenLite.killTweensOf(this.BotCircle);
		$(this.Bar).css("height", 0);
		$(this.BotCircle).css("top", -7);
		this.NextSection = 0;

		TweenLite.to(this.BotCircle, _BarTime, {
			top : this.GetHeightBar() - 7,
			ease : "easeInOutSine"});	
		
		TweenLite.to(this.Bar, _BarTime, {
			height : this.GetHeightBar(),
			ease : "easeInOutSine",		
			onUpdate : function(ListSection, SectionLength, bn){
				if (ResearchBar.NextSection >= SectionLength) return;
				var Height = $(this.target).height();
				while(true){
					if (ResearchBar.NextSection >= SectionLength) break;
					if (Height >= ListSection[ResearchBar.NextSection].Top + bn){
						ListSection[ResearchBar.NextSection].Dot.AnimateShow();
						ResearchBar.NextSection++;
					} else {
						break;
					}
				}
			},
			onUpdateParams : [
			_Research._ListGroup[_Research._GroupSelected].ListSection,
			_Research._ListGroup[_Research._GroupSelected].ListSectionLength,
			_Research._TitleHeight / 2 + $('#researchgroup').outerHeight(true)
			],
			onComplete : function(ListSection, SectionLength){
				for (var i = ResearchBar.NextSection; i < SectionLength; i++){
					ListSection[i].Dot.Show();
				}
			}, 
			onCompleteParams : [
			_Research._ListGroup[_Research._GroupSelected].ListSection,
			_Research._ListGroup[_Research._GroupSelected].ListSectionLength
			]
		});
},

Change : function(){
	TweenLite.killTweensOf(this.Bar);
	TweenLite.killTweensOf(this.BotCircle);

	TweenLite.to(this.BotCircle, _BarTime, {
		top : this.GetHeightBar() - 7,
		ease : "easeInOutSine"
	});

	TweenLite.to(this.Bar, _BarTime, {
		height : this.GetHeightBar(),
		ease : "easeInOutSine"
	});
},

GetHeightBar : function(){
	if (this.ContentHeight + this.OuterHeight < this.LeftHeight)
		return this.ContentHeight + this.OuterHeight + 8;
	else 
		return this.LeftHeight + 8;
}
}

var ResearchDot = function(grouppos){
	this.Dot = CreateDiv(_Research._SCircle, "circle " + _GroupPrefix + grouppos);
}

ResearchDot.prototype.Reposition = function(Top, Left, Type){
	TweenLite.killTweensOf(this.Dot);
	var option = {};
	if (Type == 0){
		option = {top: Top - 6, width: 9,height: 9,left: Left - 6, ease: "easeInOutSine"};
	} else if (Type == 1){
		option = {top: Top - 4, width: 5,height: 5,left: Left - 4, ease: "easeInOutSine"};
	} else {
		option = {top: Top - 4, left: Left - 4};
	}
	TweenLite.to(this.Dot, _ExpandTime, option);	
}

ResearchDot.prototype.RepositionIm = function(Top, Left, isSelected){
	TweenLite.killTweensOf(this.Dot);
	
	if (isSelected){
		$(this.Dot).css("top" , Top - 6);
		$(this.Dot).css("left" , Left - 6);	
	} else {
		$(this.Dot).css("top" , Top - 4);
		$(this.Dot).css("left" , Left - 4);	
	}
	
}

ResearchDot.prototype.AnimateShow = function(){
	$(this.Dot).css("opacity", 0);
	TweenLite.killTweensOf(this.Dot);
	TweenLite.to(this.Dot, _TextTime, {opacity: 1, ease: "easeInOutSine"});
}

ResearchDot.prototype.Show = function(){
	$(this.Dot).css("opacity", 1);
}

ResearchDot.prototype.Hide = function(){
	$(this.Dot).css("opacity", 0);
	$(this.Dot).hide();
}

///////////////////////////////////////////////////////////////////

var Btn = function(obj){
	this.Obj = obj;
	this.Init();
}

Btn.prototype.Init = function(){
	this.BorderL = CreateDiv(this.Obj, "borderleft");
	this.BorderR = CreateDiv(this.Obj, "borderright");
	this.BorderT = CreateDiv(this.Obj, "bordertop");
	this.BorderB = CreateDiv(this.Obj, "borderbottom");
}

Btn.prototype.AddLine = function(){
	var line = CreateDiv(this.Obj, "borderright");
	$(line).css("z-index", 3);
}

Btn.prototype.Resize = function(hleft, hwidth){
	$(this.Obj).css("left", hleft);
	$(this.Obj).css("width", hwidth);
}

Btn.prototype.Over = function(){
	TweenLite.killTweensOf(this.BorderL);
	TweenLite.killTweensOf(this.BorderR);
	TweenLite.killTweensOf(this.BorderT);
	TweenLite.killTweensOf(this.BorderB);
	TweenLite.to(this.BorderL, _BtnTime, {height: "100%", ease: "easeInOutSine"});
	TweenLite.to(this.BorderR, _BtnTime, {height: "100%", ease: "easeInOutSine"});
	TweenLite.to(this.BorderT, _BtnTime, {width: "100%", ease: "easeInOutSine"});
	TweenLite.to(this.BorderB, _BtnTime, {width: "100%", ease: "easeInOutSine"});
}

Btn.prototype.Out = function(){
	TweenLite.killTweensOf(this.BorderL);
	TweenLite.killTweensOf(this.BorderR);
	TweenLite.killTweensOf(this.BorderT);
	TweenLite.killTweensOf(this.BorderB);
	TweenLite.to(this.BorderL, _BtnTime, {height: 0, ease: "easeInOutSine"});
	TweenLite.to(this.BorderR, _BtnTime, {height: 0, ease: "easeInOutSine"});
	TweenLite.to(this.BorderT, _BtnTime, {width: 0, ease: "easeInOutSine"});
	TweenLite.to(this.BorderB, _BtnTime, {width: 0, ease: "easeInOutSine"});
}

Btn.prototype.ChangeCursor = function(isDefault){
	if (isDefault){
		$(this.Obj).css("cursor" , "default");
	} else {
		$(this.Obj).css("cursor" , "pointer");
	}
}

Btn.prototype.RemoveBorder = function(){
	$(this.BorderL).css("height", 0);
	$(this.BorderR).css("height", 0);
	$(this.BorderT).css("width", 0);
	$(this.BorderB).css("width", 0);
}

function CreateDiv(parent, classname){
	var ndiv = document.createElement("div");
	ndiv.className = classname;
	parent.appendChild(ndiv);
	return ndiv;
}

var _ResearchQueue = {
	_Queue : [],
	_QueueSum : [],
	_QueueReady : true,

	Push : function(group, position){
		if (this._Queue.length == 0 && this._QueueReady){
			if (position != _Research._ListGroup[group].SectionSelected){
				_Research.ExpandSectionExe(group, position);
				this._QueueReady = false;
			}
		} else {
			this._Queue.push(position);		
		}
	}, 

	Init : function(group){
		for (var i = 0; i < _Research._ListGroup[group].ListSectionLength; i++) {
			this._QueueSum[i] = 0;
		}
	},

	Sum : function(group, position){
		this._QueueSum[position]++;
		var full = true;
		for (var i = 0; i < _Research._ListGroup[group].ListSectionLength; i++) {
			if (this._QueueSum[i] < 2){
				full = false;
				break;
			}
		}
		if (full){
			this.Pop(group);
		}
	},


	Pop : function(group){
		if (this._Queue.length != 0){
			var i = this._Queue.shift();
			_Research.ExpandSectionExe(group, i);
		} else {
			this._QueueReady = true;
		}
	}
}