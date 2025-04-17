<html>
    <body>
        <h1>Bar Chart HTML</h1>
<style>
    .chart-wrap {
	 margin-left: 50px;
	 font-family: sans-serif;
	 height: 650px;
	 width: 300px;
}
 .chart-wrap .title {
	 font-weight: bold;
	 font-size: 1.62em;
	 padding: 0.5em 0 1.8em 0;
	 text-align: center;
	 white-space: nowrap;
}
 .chart-wrap.vertical .grid {
	 transform: translateY(-175px) translateX(175px) rotate(-90deg);
}
 .chart-wrap.vertical .grid .bar::after {
	 transform: translateY(-50%) rotate(45deg);
	 display: block;
}
 .chart-wrap.vertical .grid::before, .chart-wrap.vertical .grid::after {
	 transform: translateX(-0.2em) rotate(90deg);
}
 .chart-wrap .grid {
	 position: relative;
	 padding: 5px 0 5px 0;
	 height: 100%;
	 width: 100%;
	 border-left: 2px solid #aaa;
	 background: repeating-linear-gradient(90deg,transparent,transparent 19.5%,rgba(170,170,170,0.7) 20%);
}
 .chart-wrap .grid::before {
	 font-size: 0.8em;
	 font-weight: bold;
	 content: '0%';
	 position: absolute;
	 left: -0.5em;
	 top: -1.5em;
}
 .chart-wrap .grid::after {
	 font-size: 0.8em;
	 font-weight: bold;
	 content: '100%';
	 position: absolute;
	 right: -1.5em;
	 top: -1.5em;
}
 .chart-wrap .bar {
	 width: var(--bar-value);
	 height: 50px;
	 margin: 30px 0;
	 background-color: #F16335;
	 border-radius: 0 3px 3px 0;
}
 .chart-wrap .bar:hover {
	 opacity: 0.7;
}
 .chart-wrap .bar::after {
	 content: attr(data-name);
	 margin-left: 100%;
	 padding: 10px;
	 display: inline-block;
	 white-space: nowrap;
}
 
</style>
<div class="chart-wrap vertical">
  <h2 class="title">Bar Chart HTML Example:  Using Only HTML And CSS</h2>
  
  <div class="grid">
      <div class="bar" style="--bar-value:85%;" data-name="Your Blog" title="Your Blog 85%"></div>
      <div class="bar" style="--bar-value:23%;" data-name="Medium" title="Medium 23%"></div>
     <div class="bar" style="--bar-value:7%;" data-name="Tumblr" title="Tumblr 7%"></div>
      <div class="bar" style="--bar-value:38%;" data-name="Facebook" title="Facebook 38%"></div>
      <div class="bar" style="--bar-value:35%;" data-name="YouTube" title="YouTube 35%"></div>
      <div class="bar" style="--bar-value:30%;" data-name="LinkedIn" title="LinkedIn 30%"></div>
      <div class="bar" style="--bar-value:5%;" data-name="Twitter" title="Twitter 5%"></div>
      <div class="bar" style="--bar-value:20%;" data-name="Other" title="Other 20%"></div>    
  </div>
</div>



    </body>
</html>