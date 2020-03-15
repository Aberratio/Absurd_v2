window.onload = start;

var declaration = new Array(35);
var bidding_string_value = "";

declaration[0] = '1 <b style="color:green">&clubs;</b>';
declaration[1] = '1 <b style="color:orange">&diams;</b>';
declaration[2] = '1 <b style="color:red">&hearts;</b>';
declaration[3] = '1 <b style="color:blue">&spades;</b>';
declaration[4] = "1NT";
declaration[5] = '2 <b style="color:green">&clubs;</b>';
declaration[6] = '2 <b style="color:orange">&diams;</b>';
declaration[7] = '2 <b style="color:red">&hearts;</b>';
declaration[8] = '2 <b style="color:blue">&spades;</b>';
declaration[9] = "2NT";
declaration[10] = '3 <b style="color:green">&clubs;</b>';
declaration[11] = '3 <b style="color:orange">&diams;</b>';
declaration[12] = '3 <b style="color:red">&hearts;</b>';
declaration[13] = '3 <b style="color:blue">&spades;</b>';
declaration[14] = "3NT";
declaration[15] = '4 <b style="color:green">&clubs;</b>';
declaration[16] = '4 <b style="color:orange">&diams;</b>';
declaration[17] = '4 <b style="color:red">&hearts;</b>';
declaration[18] = '4 <b style="color:blue">&spades;</b>';
declaration[19] = "4NT";
declaration[20] = '5 <b style="color:green">&clubs;</b>';
declaration[21] = '5 <b style="color:orange">&diams;</b>';
declaration[22] = '5 <b style="color:red">&hearts;</b>';
declaration[23] = '5 <b style="color:blue">&spades;</b>';
declaration[24] = "5NT";
declaration[25] = '6 <b style="color:green">&clubs;</b>';
declaration[26] = '6 <b style="color:orange">&diams;</b>';
declaration[27] = '6 <b style="color:red">&hearts;</b>';
declaration[28] = '6 <b style="color:blue">&spades;</b>';
declaration[29] = "6NT";
declaration[30] = '7 <b style="color:green">&clubs;</b>';
declaration[31] = '7 <b style="color:orange">&diams;</b>';
declaration[32] = '7 <b style="color:red">&hearts;</b>';
declaration[33] = '7 <b style="color:blue">&spades;</b>';
declaration[34] = "7NT";

function is_bidding_over() {
  var bids = read_bidding_string();
  if (bids[bids.length - 1] == "36") {
    return true;
  }
  return false;
}

function start() {
  var div_content = "";
  for (i = 0; i <= 34; i++) {
    div_content =
      div_content +
      '<div class="bid" onclick="declare(' +
      i +
      ')" id="bid' +
      i +
      '">' +
      declaration[i] +
      "</div>";
    if ((i + 1) % 5 == 0) {
      div_content = div_content + '<div style="clear:both;"></div>';
    }
  }

  document.getElementById("biddingbox_top").innerHTML = div_content;

  run_bidding();

  var point_string = document.getElementById("points_table").innerHTML;

  if (point_string.length > 0) {
    var div_content =
      "<table style='border-collapse: separate; border-spacing: 50px 0; margin-bottom: 50px;'><tr style='color: #263f31; font-size: 20px;'><td>Contract</td><td>Points</td></tr>";
    var res = point_string.split(";");

    for (var i = 0; i < res.length; i++) {
      res2 = res[i].split("=");
      div_content =
        div_content +
        "<tr><td>" +
        declaration[res2[0].trim()] +
        "</td><td>" +
        res2[1] +
        "</td></tr>";
    }

    div_content = div_content + "</table>";

    document.getElementById("points_table").innerHTML = div_content;
  }
}

var odd = true;
var last_bidded_index = [-1];

function declare(bid_index) {
  if (
    document.getElementById("turn").innerText ==
    document.getElementById("hand").innerText
  ) {
    bidding_string_value = bidding_string_value + ";" + bid_index;
    document.getElementById("new_bidding_string").value = bidding_string_value;

    write_bid(bid_index);
    myButton = document.getElementById("send_button");
    myButton.type = "submit";

    if (document.getElementById("turn").innerText == "N") {
      document.getElementById("turn").innerHTML = "S";
    } else {
      document.getElementById("turn").innerHTML = "N";
    }
  } else {
    //alert("nierowne!" + document.getElementById("turn").innerText + "nierowne!" + document.getElementById("hand").innerText + "nierowne!");
  }
}

function write_bid(bid_index) {
  if (bid_index >= 0 && bid_index <= 38) {
    if (
      bid_index >= 35 ||
      document
        .getElementById("bid" + bid_index)
        .style.getPropertyValue("background") != "rgb(49, 49, 49)"
    ) {
      if (bid_index <= 34) {
        for (i = 0; i <= bid_index; i++) {
          var element = "bid" + i;
          document.getElementById(element).style.background = "#313131";
          document.getElementById(element).style.cursor = "default";
        }
        last_bidded_index.push(bid_index);
      }

      var table = document.getElementById("bidding_desk");

      if (bid_index == 38) {
        var rows_counter = table.rows.length - 1;
        if (rows_counter >= 1) {
          var rowToEdit = table.rows[rows_counter];
          if (odd) {
            rowToEdit.cells[2].innerHTML = "";
            rowToEdit.cells[3].innerHTML = "";
          } else {
            table.deleteRow(rows_counter);
          }

          odd = !odd;
          var y = last_bidded_index.pop();
          var x = last_bidded_index.pop();
          last_bidded_index.push(x);

          if (y <= 34) {
            for (i = 34; i > x; i--) {
              var element = "bid" + i;
              document.getElementById(element).style.background = "black";
              document.getElementById(element).style.cursor = "";
            }
          }
        }
      } else {
        var bid_element;

        if (bid_index == 35) {
          last_bidded_index.push(bid_index);
          bid_element = "&#10060;";
        } else if (bid_index == 36) {
          last_bidded_index.push(bid_index);
          bid_element = "PASS";
        } else if (bid_index == 37) {
          last_bidded_index.push(bid_index);
          bid_element = "&#10060;&#10060;";
        } else {
          bid_element = declaration[bid_index];
        }

        if (odd) {
          var row = table.insertRow(table.rows.length);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          cell1.innerHTML = bid_element;
          cell2.innerHTML = "PASS";
          cell3.innerHTML = "";
          cell4.innerHTML = "";
        } else {
          var rowToEdit = table.rows[table.rows.length - 1];
          rowToEdit.cells[2].innerHTML = bid_element;
          rowToEdit.cells[3].innerHTML = "PASS";
        }
        odd = !odd;
      }
    }
  }
}

function read_bidding_string() {
  bidding_string_value = document.getElementById("bidding_string").innerHTML;
  document.getElementById("bidding_string").innerHTML = " ";
  document.getElementById("new_bidding_string").value = bidding_string_value;

  var res = bidding_string_value.split(";");
  return res;
}

function run_bidding() {
  bidding_string_value = document.getElementById("bidding_string").innerHTML;
  document.getElementById("bidding_string").innerHTML = " ";
  document.getElementById("new_bidding_string").value = bidding_string_value;

  var res = bidding_string_value.split(";");
  var i;
  for (i = 0; i < res.length; i++) {
    write_bid(res[i]);
  }
}
