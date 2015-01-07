    <div class="row">
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <h1 class="page-title txt-color-blueDark">Plugins &gt;
		<span>Temperatur Test</span></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="well">
          <div class="row margin-top-10 step-1">
            <div class="col-sm-12 text-center margin-bottom-10">
              <div class="row">
                <div class="col-sm-6 text-center">
                  <div id="leftstack">
					<p>Available temperatures:</p>
                    <ul id="temperatures">
                      <li class="ui-state-default">160&deg;C</li>
                      <li class="ui-state-default">165&deg;C</li>
                      <li class="ui-state-default">170&deg;C</li>
                      <li class="ui-state-default">175&deg;C</li>
                      <li class="ui-state-default">180&deg;C</li>
                      <li class="ui-state-default">185&deg;C</li>
                      <li class="ui-state-default">190&deg;C</li>
                      <li class="ui-state-default">195&deg;C</li>
                      <li class="ui-state-default">200&deg;C</li>
                      <li class="ui-state-default">205&deg;C</li>
                      <li class="ui-state-default">210&deg;C</li>
                      <li class="ui-state-default">215&deg;C</li>
                      <li class="ui-state-default">220&deg;C</li>
                      <li class="ui-state-default">225&deg;C</li>
                      <li class="ui-state-default">230&deg;C</li>
                    </ul>
                  </div>
                  <div id="rightstack">
					<p>Temperatures to test:</p>
                    <ul id="selectedtemperatures"></ul>
					<p>Heatbed</p>
                  </div>
                <br>
                <div id="bed">
					<label for="bedtemperature1">Bed temperature - first layer:</label> 
					<input id="bedtemperature1" type="text" value="90" /><br>
					<label for="bedtemperature">Bed temperature:</label> 
					<input id="bedtemperature" type="text" value="80" /><br>
					<label for="printtemperature">Print temperature - first layer:</label> 
					<input id="printtemperature" type="text" value="160" />
				</div>
              </div>
			<div id="dialog-no-selected" title="No temperatures are selected!">
				<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>There are no temperatures to test.</p>
			</div>
            
            <div class="col-sm-6">
              <h1>
                <span class="badge bg-color-blue txt-color-white">1</span>
              </h1>
              <h2>This Plugin allows you to print a test tower with a new filament, head, etc... <br> You can choose the temperatures you would like to test by draging it from the left stack to the right one. 
              <br />Click &quot;Start&quot; when you selected the temperatures.</h2>
			  <p>Common temperaturs range are PLA: 160&deg;C - 220&deg;C ABS: 200&deg;C - 260&deg;C</p>
              <hr />
              <p class="text-center">
                <a href="javascript:void(0);" class="btn btn-primary btn-default gen-temptest">Start</a>
              </p>
            </div>
          </div>
        </div>
      </div>
	  
	<div class="row margin-top-10 step-2" style="display:none;">
		<div class="col-sm-12">
			<div class="well">
				<div class="row">
					<div class="col-sm-6 text-center">
					</div>
					<div class="col-sm-6 ">
						<h1 class="text-center" ><span class="badge bg-color-blue txt-color-white">2</span></h1>
						<h4 class="text-center">Test rod generated:<br>
						<div class="todo margin-top-10"></div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
	  
    </div>
	</div>
	</div>
	

