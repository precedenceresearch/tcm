<html>
    <body>
        <style>
            .chart-wrap {
	 width: 650px;
	 height: 600px;
	 font-family: sans-serif;
}
 .chart-wrap .title {
	 text-align: center;
}
 .grid {
	 width: 100%;
	 height: 100%;
	 display: flex;
	 flex-direction: row;
	 justify-content: center;
	 border-bottom: 2px solid #aaa;
	 background: repeating-linear-gradient(0deg,transparent,transparent 19.5%,rgba(170,170,170,0.7) 20%);
}
 .grid .bar {
	 background-color: #F16335;
	 width: 45px;
	 height: var(--bar-value);
	 align-self: flex-end;
	 margin: 0 auto;
	 border-radius: 3px 3px 0 0;
	 position: relative;
}
 .grid .bar.bar:hover {
	 opacity: 0.7;
}
 .grid .bar::after {
	 content: attr(data-name);
	 top: -3em;
	 padding: 10px;
	 display: inline-block;
	 white-space: nowrap;
	 position: absolute;
	 transform: rotate(-45deg);
}
 .grid.horizontal {
	 flex-direction: column;
	 border-bottom: none;
	 border-left: 2px solid #aaa;
	 background: repeating-linear-gradient(90deg,transparent,transparent 19.5%,rgba(170,170,170,0.7) 20%);
}
 .grid.horizontal .bar {
	 height: 45px;
	 width: var(--bar-value);
	 align-self: flex-start;
	 margin: auto 0 auto 0;
	 border-radius: 0 3px 3px 0;
}
 .grid.horizontal .bar::after {
	 top: initial;
	 left: 100%;
	 padding: 0 10px;
	 display: inline-block;
	 white-space: nowrap;
	 position: absolute;
	 transform: rotate(0deg);
	 line-height: 45px;
}
 
        </style>
        <div class="chart-wrap">
  <h2 class="title">HTML Bar Graph Example Using Flexbox</h2>
  <div class="grid horizontal">
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