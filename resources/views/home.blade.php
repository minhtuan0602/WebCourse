<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Trang chủ</title>
  
  <script src="/home_page/jquery/jquery.js"></script>
  <script src="/home_page/GSAP/TweenLite.min.js"></script>
  <script src="/home_page/GSAP/plugins/CSSPlugin.min.js"></script>
  <script src="/home_page/GSAP/plugins/ScrollToPlugin.min.js"></script>
  <link rel="stylesheet" href="/home_page/style/style.css">
</head>
<body style="margin:0px;padding:0px">
    <div id="container">
        <div id="navbar"></div>
        <div id="listcate">
            <div id="listcateul">
                <div id="btnclose"></div>
            </div>
        </div>
        <article id="news">
            <div id="newstopbg"></div>
            <div id="newsbody">
                <img id="newslogo" src="/home_page/images/logo.png">  
                <div id = "listnewssec">
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news1.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news2.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news3.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news4.jpg')"></div></section>
                    <section><div class="bgnews" style="background-image:url('/home_page/images/news5.jpg')"></div></section>
                </div>
                <div id = "listpoint"></div>
                <div id = "newsbottom">
                    <div id="newsbox">
                        <div id="newstitle">Get Shit Done Kit Pro</div>
                        <div id="newstext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed leo lobortis, semper risus sit amet, mollis metus. </div>
                        <div id="newsbtn">TIN TỨC</div>        
                    </div>
                </div>    
            </div>
            <div id="art">
                <div class="titleart"></div>
                <div class="bodyart"></div>
            </div>
        </article>
        <article id="academics">
            <div class="acabg1"></div>
            <div class="acabg1"></div>
            <div class="acabg2"></div>
            <div class="acabg2"></div>
            <div id = "listsec">
                <div id="listsecbg"></div>
                <?php $i = 1; ?>
                @foreach ($articles_training as $article)
                <section>
                    <div class="bgveil"></div>
                    <div class="bg"><img class="bgimg" src="/home_page/images/aca{{ $i }}.jpg"></div>
                    <div class="title">{{ $article->title }}</div>
                    <div class="description">{{ $article->description }}</div>
                    <div class="acatext">{!! html_entity_decode($article->content) !!}</div>
                </section>
                <?php $i++; ?>
                @endforeach
            </div>
        </article>
        <article id="research" style="">
            <div id="headerresearch"></div>
            <div id="leftresearch">
                <div id="leftresearchbar" class="top0"></div>
                <div id="scircleresearch"></div>
            </div>
            <div id="researchgroup">
                <div class="titlegroup">LĨNH VỰC NGHIÊN CỨU</div>
                <div class="titlegroup">CÁC BÀI BÁO KHOA HỌC</div>
            </div>
            <div id="accordion">
                @foreach( $articles_research_type_1 as $article)
                <section class="SG0">
                    <div class="retitle">{{ $article->title }}</div>
                    <div class="retext"><div class="retextin">{!! html_entity_decode($article->content) !!}</div></div>
                </section>
                @endforeach
                @foreach( $articles_research_type_2 as $article)
                <section class="SG1">
                    <div class="retitle">{{ $article->title }}</div>
                    <div class="retext"><div class="retextin">{!! html_entity_decode($article->content) !!}</div></div>
                </section>
                @endforeach
            </div>
            <div id="footresearch"></div>
        </article>
        <article id="about">
            <div id="aboutcontent">
                <img id="logo" src="/home_page/images/logo.png">
                <div id="textabout">
                    @foreach ($articles_history as $article)
                    <div class="intextabout">{!! $article->content !!}</div>
                    @endforeach
                </div>
                <div id="aboutline"></div>
                <img id="aboutlinelogo" src="/home_page/images/logosd.png">
                <div id="abouthead">
                    @foreach ($articles_history as $article)
                    <div class="titleabout">{{ $article->title }}</div>
                    @endforeach
                </div>
            </div>
        </article>
        <div id="footer">
            <div id="footertop">
                <div id="footercontent">
                    <div id="footershare">
                        <img class="sharebtn" src="/home_page/images/aca1.jpg">
                        <img class="sharebtn" src="/home_page/images/aca2.jpg">
                        <img class="sharebtn" src="/home_page/images/aca3.jpg">
                    </div>
                    <img id="footerlinelogo" src="/home_page/images/logosd.png">    
                </div>
            </div>
            <div id="footerbot">
                <div id="footertext">
                    Block A3, Ho Chi Minh City University of Technology<br/>
                    Address: 268 Ly Thuong Kiet Street, District 10, Hochiminh City, Vietnam<br/>
                    Tel: (+84 8) 865-8689 Fax: (+84 8) 864-5137<br/>
                    <br/>
                    Copyright ©2015
                </div>
            </div>
        </div>
    </div>
    <script src="/home_page/scripts/home.js"></script>
    <script src="/home_page/scripts/scroll.js"></script>
    <script src="/home_page/scripts/nav.js"></script>
    <script src="/home_page/scripts/academics.js"></script>
    <script src="/home_page/scripts/news.js"></script>
    <script src="/home_page/scripts/research.js"></script>
    <script src="/home_page/scripts/about.js"></script>
    <script type="text/javascript">
        var _NAVDATA = ['TRANG CHỦ', 'ĐÀO TẠO', 'NGHIÊN CỨU', 'GIỚI THIỆU'];
        var _CATEDATA = ['TẤT CẢ TIN'];
        var _CATEID = [-1];
        <?php
        foreach ($category_news as $category) { ?>
            _CATEDATA.push('<?php echo $category->name; ?>');
            _CATEID.push(<?php echo $category->id; ?>);
            <?php
        }
        ?>
    </script>
</body>
</html>
