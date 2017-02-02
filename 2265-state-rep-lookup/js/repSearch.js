
jQuery(document).ready(function() {

//finction stary
function getReps(these, city){
  var text = '';
  var first_name = '';
  var last_name = '';
  
  var profile = '';
  var fullname = '';
  var chamber = '';
  var profile_image = '';
    jQuery.ajax({
      type: 'GET',
      url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + these + ',+' + city + ',+MA&key=AIzaSyBrrPv7d8sYRxmd1jcEdJto9nV0pbwytoY',
        dataType: 'json',
        // crossDomain: true,
      }).done(function(response){
        console.log(response);
        jQuery.each(response, function(idx, cur_property){                 
          jQuery.ajax({
            type: 'GET',
            url: 'https://openstates.org/api/v1//legislators/geo/?lat=' + cur_property[0]['geometry']['location']['lat'] + '&long=' + cur_property[0]['geometry']['location']['lng'] + '&apikey=bde4a26e4366494ab18e299a347d7f95',
                // data: { theseAssignedProps : assigned_properties, action: 'getMmcProperties' },
            dataType: 'json',
            crossDomain: true,
            }).done(function(response){
                
                  console.log(response);
            
                  jQuery.each(response, function(idx, cur_property){
                    // text += '<div>Leg idx: ' + idx + '</div>';
                    // text += '<div>leg prop: ' + cur_property + '</div>';


                    if ( typeof(cur_property) == 'object' ) { 


                        //alert(typeof(cur_property)) 
                        jQuery.each(cur_property, function(idx1, cur_property1){
                          //text += '<h4>cnnc: ' + idx1 + '</h4>';
                          /*if( idx1 == 'all_ids') {
                            
                            text += '<h4>IDS: ' + cur_property1 + '</h4>';
                          }*/
                          if( idx1 == 'full_name') {
                            fullname +=  cur_property1;
                            
                          }
                          if( idx1 == 'first_name') {
                            first_name +=  cur_property1;
                            first_name = first_name.substring(0, first_name.indexOf(' '));
                            
                          }
                          if( idx1 == 'last_name') {
                            last_name +=  cur_property1;
                            
                          }
                          if( idx1 == 'chamber') {
                            if( cur_property1 == 'lower') {
                              chamber += '<B>Representative</B>';
                            } else {
                              chamber += '<B>Senator</B>';
                            }
                            
                          }
                          /*
                          if( idx1 == 'photo_url') {

                            profile_image += '<img src="' + cur_property1 + '"><B>I</B></div>';
                          }
                          if( idx1 == 'email') {
                            

                            profile += '<div class="rep-search-result"><B>Your Rep: ' + cur_property1 + '</B></div>';
                            profile += '<a href="http://www.beaconhillrollcall.com/directory-of-representatives/"><button type="button" class="btn btn-info" ID="submit-my-address">';

                            profile += 'Get 2015 - 2016 Report</button></a>';
                          }*/
                
                        });
                          if (chamber == '<B>Representative</B>' ){
                              if( fullname != '' ){
                                text += '<div class="rep-search-result"><B>Your ' + chamber + ' ' + fullname;
                                text += '<br><a href="http://www.beaconhillrollcall.com/?s=' + first_name + ' ' + last_name + '">';
                                text += '<button type="button" class="btn btn-info" >View Profile</button></a></div>';
                                jQuery('.bhrc_leg_search').append(text);
                              } else {
                                text += '<div class="rep-search-result">We weren\'t able to find your representative. Check the state government\'s site here then come back check their voting record</div>';
                                jQuery('.bhrc_leg_search').append(text);
                              }
                          }

                          if (chamber == '<B>Senator</B>' ){
                              if( fullname != '' ){
                                text += '<div class="rep-search-result"><B>Your ' + chamber + ' ' + fullname;
                                text += '<br><a href="http://www.beaconhillrollcall.com/?s=' + first_name + ' ' + last_name + '">';
                                text += '<button type="button" class="btn btn-info" >View Profile</button></a></div>';
                                jQuery('.bhrc_leg_search').append(text);
                              } else {
                                text += '<div class="rep-search-result">We weren\'t able to find your Senator. Check the state government\'s site here then come back check their voting record</div>';
                                jQuery('.bhrc_leg_search').append(text);
                              }
                          }
                          text = '';
                          chamber = '';
                          fullname = '';
                          first_name = '';
                          last_name = '';
                        
                //text += '<div class="rep-search-result"><B>Your ' + profile_image + '</div>';
                        

                   
            }

          
    
                 });

                //jQuery('.bhrc_leg_search').append(text);
                //jQuery('.bhrc_leg_search').append(text);

                
                /*jQuery('.fgpsn_properties_menu').append('<option value="' + response['propertymenu'][0]['property_id'] + '">' +  response['propertymenu'][0]['street_addr1']+ '</option>');*/
        }).fail(function(error){
      //alert('fail ' + error.statusText);
        console.log(error.statusText);
    });


    // openstates.org/api/v1//legislators/geo/?lat=%2037.422364&long=%20-122.084364&apikey=bde4a26e4366494ab18e299a347d7f95
    
                 });

                
                jQuery('.bhrc_leg_search').append(text);

                
                /*jQuery('.fgpsn_properties_menu').append('<option value="' + response['propertymenu'][0]['property_id'] + '">' +  response['propertymenu'][0]['street_addr1']+ '</option>');*/
        }).fail(function(error){
      //alert('fail ' + error.statusText);
        console.log(error.statusText);
    });

  }

  var dndn = document.getElementById('submit-my-address');
  //alert(dndn);
  jQuery('#submit-my-address').click(function() {
    //alert( jQuery('input#my-address').val() );
    getReps( jQuery('input#my-address').val(), jQuery('input#my-city').val() );
  });

});
