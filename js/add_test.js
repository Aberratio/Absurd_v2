window.onload = start;

var declaration = new Array(35);
var bidding_string_value ="";

declaration[0] = "1 <b style=\"color:green\">&clubs;</b>";
declaration[1] = "1 <b style=\"color:orange\">&diams;</b>";
declaration[2] = "1 <b style=\"color:red\">&hearts;</b>";
declaration[3] = "1 <b style=\"color:blue\">&spades;</b>";
declaration[4] = "1NT";
declaration[5] = "2 <b style=\"color:green\">&clubs;</b>";
declaration[6] = "2 <b style=\"color:orange\">&diams;</b>";
declaration[7] = "2 <b style=\"color:red\">&hearts;</b>";
declaration[8] = "2 <b style=\"color:blue\">&spades;</b>";
declaration[9] = "2NT";
declaration[10] = "3 <b style=\"color:green\">&clubs;</b>";
declaration[11] = "3 <b style=\"color:orange\">&diams;</b>";
declaration[12] = "3 <b style=\"color:red\">&hearts;</b>";
declaration[13] = "3 <b style=\"color:blue\">&spades;</b>";
declaration[14] = "3NT";
declaration[15] = "4 <b style=\"color:green\">&clubs;</b>";
declaration[16] = "4 <b style=\"color:orange\">&diams;</b>";
declaration[17] = "4 <b style=\"color:red\">&hearts;</b>";
declaration[18] = "4 <b style=\"color:blue\">&spades;</b>";
declaration[19] = "4NT";
declaration[20] = "5 <b style=\"color:green\">&clubs;</b>";
declaration[21] = "5 <b style=\"color:orange\">&diams;</b>";
declaration[22] = "5 <b style=\"color:red\">&hearts;</b>";
declaration[23] = "5 <b style=\"color:blue\">&spades;</b>";
declaration[24] = "5NT";
declaration[25] = "6 <b style=\"color:green\">&clubs;</b>";
declaration[26] = "6 <b style=\"color:orange\">&diams;</b>";
declaration[27] = "6 <b style=\"color:red\">&hearts;</b>";
declaration[28] = "6 <b style=\"color:blue\">&spades;</b>";
declaration[29] = "6NT";
declaration[30] = "7 <b style=\"color:green\">&clubs;</b>";
declaration[31] = "7 <b style=\"color:orange\">&diams;</b>";
declaration[32] = "7 <b style=\"color:red\">&hearts;</b>";
declaration[33] = "7 <b style=\"color:blue\">&spades;</b>";
declaration[34] = "7NT";

function is_bidding_over() {
    var bids = read_bidding_string();
    if(bids[bids.length - 1] == "36") {
        return true;
    }
    return false;
}

function start() {
    var div_content = "";
        for(i = 0; i <= 34; i++) {
            div_content = div_content + '<button class="bid" id="bid'+i+'" data-value="'+i+'">' + declaration[i] + '</button>';
            if((i + 1) % 5 == 0) {
                div_content = div_content + '<div style="clear:both;"></div>'
            }
            
        }

    document.getElementById("biddingbox_top").innerHTML = div_content;

    var input = $('#points_input');
   
    for(i = 0; i <= 34; i++) {
        $('#bid'+i).click(function() {
            if(input.val() !== null) {
                var value = input.val() + $(this).attr('data-value')+"=";
            } else {
                var value = $(this).attr('data-value')+"=";    
            }
            

            input.val(value);
        });
    }
}

 