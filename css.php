<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<style type="text/css">
		html body{
			background-color: #4fbbb2;
			overflow-x: hidden;
		}
		.navbar{
			position: fixed;
			z-index: 100;
		}
		.nav-item{
			margin-left: 15px;
			margin-right: 15px;
		}
		.nav-item a:hover {
		  text-decoration: none;
		}
		.Wrapper{
			overflow-x: scroll;
			overflow-y: hidden;
			white-space: nowrap;
		}
		#search{
			width: 400px;
			height: 32px;
			border: none;
			font-size: 18px;
			box-shadow: 0px 0px 12px #AAAAAA;
			border-radius: 50px;
			text-align: center;
		}
		#search_healthCenter{
			width: 400px;
			height: 32px;
			border: none;
			font-size: 18px;
			box-shadow: 0px 0px 12px #AAAAAA;
			border-radius: 50px;
			text-align: center;
		}
		#search_Item{
			width: 400px;
			height: 32px;
			border: none;
			font-size: 18px;
			box-shadow: 0px 0px 12px #AAAAAA;
			border-radius: 50px;
			text-align: center;
		}
		#search_Transaction{
			width: 400px;
			height: 32px;
			border: none;
			font-size: 18px;
			box-shadow: 0px 0px 12px #AAAAAA;
			border-radius: 50px;
			text-align: center;
		}
		.btnsss{
			width: 30px;
			height: 30px;

			border-radius: 7px;
			border: none;
			background-color: white;
			box-shadow: 0px 0px 5px #222222;
			outline: none !important;

			margin: 3px;
			margin-bottom: 5px;
		}
		.btnsss img{
			width: 20px;
			height: 20px;

			margin-top: 4px;
		}
		.edit_but{
			border: none;
			background-color: transparent;

			float: right; 
			margin-right: -25px;
			z-index: 60;
			position: relative;
		}
		.delete_but{
			border: none;
			background-color: transparent;

			float: right; 
			margin-right: -27px;
			z-index: 60;
			position: relative;

		}
		.btns{
			border: none;
			border-radius: 30px;
			width: 110px;
			height: 30px;
			font-weight: normal;
			font-size: 14px;
			background-color: white;
			color: #BCC6CC;
			outline: none;
			box-shadow: 0px 0px 5px #222222;
			margin-right: 5px;
			margin-left: 5px;
		}
		.dropdown{
			margin-right: 10px;
			margin-left: 10px;
		}
		.dropdown_btns{
			margin-top: 16px;
			margin-bottom: 12px;

			border-radius: 30px;
			width: 130px;
			height: 30px;
			font-weight: bold;
			font-size: 14px;
			background-color: white;
			color: #4fbbb2;
			outline: none !important;
			box-shadow: 0px 0px 5px #222222;
		}
		.dropdown_btnss{
			margin-bottom: 12px;

			border-radius: 30px;
			width: 130px;
			height: 30px;
			font-weight: bold;
			font-size: 14px;
			background-color: white;
			color: #4fbbb2;
			outline: none !important;
			box-shadow: 0px 0px 5px #222222;
		}
		.dropdown-item{
			font-size: 14px;
			background-color: transparent !important;
			cursor: pointer;
		}
		.dropdown-menu a:hover{
			background-color: #f2f2f2 !important;
			border-radius: 20px;
		}
		.dropdown-menu{
			color: #4fbbb2;
			width: 8%;
			border-radius: 20px; 
			margin-left: -14.5px;
		}
		.Image_Admin{
			height: 80px;
			width: 80px;
			object-fit: contain;
			border-radius: 10px;
			margin-top: 10px;
			margin-bottom: 10px;
			margin-left: 0px;
		}
		.Image_Item{
			height: 80px;
			width: 80px;
			object-fit: contain;
			border-radius: 10px;
			margin-top: 10px;
			margin-bottom: 10px;
			margin-left: 0px;
		}
		.Image_HealthCenter{
			height: 80px;
			width: 80px;
			object-fit: contain;
			border-radius: 10px;
			margin-top: 10px;
			margin-bottom: 10px;
			margin-left: 0px;
		}
		.iconn{
			background-color: white;
			border-radius: 10px;
			margin: 5px;
			width: 340px;
			box-shadow: 0px 0px 7px #404040;
			position: relative;
		}
		.iconnnn{
			background-color: white;
			border-radius: 10px;
			margin: 5px;
			width: 340px;
			box-shadow: 0px 0px 7px #404040;
			position: relative;
			display: inline-block;
		}
		.data{
			line-height: 1.4;
			color: #4fbbb2;
			font-size: 15px;
			font-weight: 400;
			margin-top: 6px;
		}
		.Admin_Type{
			font-size: 12px;
			font-weight: 700;
			font-style: italic;
		}
		.HealthCenter_Type{
			font-size: 14px;
			font-weight: 700;
			font-style: italic;
		}
		.HealthCenter{
			font-size: 12px;
			font-weight: 700;
			font-style: italic;
		}
		.Filter_HealthCenter{
			z-index: 50;
			width: 340px;
			height: 100px;
			border-radius: 10px;
			border: none;
			outline: none !important;
			background-color: transparent;
			position: absolute;
		}
		.Id_StockHouse{
			font-size: 15px;
			font-weight: 700;
			font-style: italic;
		}
		.Category_Item{
			font-size: 15px;
			font-weight: 700;
			font-style: italic;
		}
		.SubCategory_Item{
			font-size: 13px;
			font-weight: 700;
			font-style: italic;
		}
		.Order_Item{
			width: 340px;
			height: 100px;
			border-radius: 10px;
			border: none;
			outline: none !important;
			background-color: black;
			opacity: 0;
			position: absolute;
			z-index: 50;

			text-align: center;
			padding-bottom: 20px;
			font-size: 60px;
			font-weight: bold;
			color: white;
		}
		.qty_Order{
			text-align: center; 
			border: none; 
			color: #182936; 
			font-weight: bold;
			width: 40px;
		}
		.Filter_Item{
			width: 340px;
			height: 100px;
			border-radius: 10px;
			border: none;
			outline: none !important;
			background-color: transparent;
			position: absolute;
			z-index: 50;
		}
		.Id_Transaction{
			font-size: 17px;
			font-weight: 700;
		}
		.Status_Transaction{
			font-size: 14px;
			font-weight: 500;
		}
		.butonnn{
			font-size: 14px;
			margin-right: auto;
			font-weight: 500;
		}
		.Date_Transaction{
			font-size: 13px;
			font-weight: 500;
		}
		.Confirm_Transaction{
			font-size: 12px;
			color: red;
			font-weight: 750;
			margin-bottom: 5px;
		}
		.Filter_Transaction{
			width: 340px;
			height: 100%;
			border-radius: 10px;
			border: none;
			outline: none !important;
			background-color: transparent;
			position: absolute;
			z-index: 50;
		}

		#Confirm_Date {
			align-content: center;
			text-align: center;
			margin: auto;
			color: white;
			border-radius: 20px;
			background-color: #4fbbb2B0;
			width: 150px;
			font-size: 14px;
			font-weight: 500;

			margin-top: 4px;
			margin-bottom: 12px;
		}
		#Confirm_HealthCenter {
			align-content: center;
			text-align: center;
			font-weight: 700;
		}
		#Confirm_Id {
			align-content: center;
			text-align: center;
			font-weight: 500;
			color: #4fbbb2;
		}
		#Confirm_Item {
			align-content: center;
			text-align: center;
			font-weight: 700;
		}
		#qty_Confirm{
			width: 100px;
			border-color: #e5e5e5;
			border-radius: 20px;
			height: 30px;
			text-align: center;
			color: #4fbbb2;
			font-size: 16px;
			margin-bottom: 10px;
		}
		#stock_Confirm{
			color: #4fbbb2;
			font-size: 16px;
			font-weight: 500;
			margin-bottom: 5px;
		}
		.modal-content{
			border-radius: 30px;
		}
		.modal{
			top: 20%;
		}
		.modalText {
			align-content: center;
			text-align: center;
			color: #4fbbb2;
			font-size: 16px;
			font-weight: 500;
		}
		.modalText>input{
			color: #4fbbb2;
			border-radius: 20px;
			width: 400px;
			text-align: center;
			margin-left: 25px;
			margin-bottom: 10px;
		}
		input:focus{
			outline: none;
		}
		input::-webkit-inner-spin-button {
		  -webkit-appearance: none;
		  margin: 0;
		}


		#qty_Order{
			width: 100px;
			border-color: #e5e5e5;
			border-radius: 20px;
			height: 30px;
			text-align: center;
			color: #4fbbb2;
			font-size: 16px;
			margin-bottom: 10px;
		}
		.Title_modal {
			align-content: center;
			text-align: center;
			color: #4fbbb2;
			font-size: 24px;
			font-weight: 500;
		}
		#Transaction_Date {
			align-content: center;
			text-align: center;
			margin: auto;
			color: white;
			border-radius: 20px;
			background-color: #4fbbb2B0;
			width: 150px;
			font-size: 14px;
			font-weight: 500;

			margin-top: 4px;
			margin-bottom: 12px;
		}
		#Transaction_HealthCenter {
			align-content: center;
			text-align: center;
			color: #4fbbb2;
			font-size: 24px;
			font-weight: 500;
		}
		#search_Stock{
			width: 300px;
			height: 26px;
			border: none;
			font-size: 14px;
			box-shadow: 0px 0px 7px #AAAAAA;
			border-radius: 50px;
			text-align: center;
			margin-bottom: 10px;
			margin-top: -5px;
		}
		#Stock{
		  position: fixed;
		  z-index: 1000;
		  bottom: -300px; /* Position them outside of the screen */
		  transition: 0.6s; /* Add transition on hover */
		  width: 100%;
		  padding-top: 10px;
		  background-color: #182936;
		  border-radius: 70px 70px 0px 0px;

		  max-height: 40%;
		  overflow-y: auto;
		}
		#Stock::-webkit-scrollbar {
		  display: none;
		}
		#search_Mutasi{
			width: 300px;
			height: 26px;
			border: none;
			font-size: 14px;
			box-shadow: 0px 0px 7px #AAAAAA;
			border-radius: 50px;
			text-align: center;
			margin-bottom: 10px;
			margin-top: -5px;
		}
		#search_Detail{
			width: 300px;
			height: 26px;
			border: none;
			font-size: 14px;
			box-shadow: 0px 0px 7px #AAAAAA;
			border-radius: 50px;
			text-align: center;
			margin-bottom: 10px;
			margin-top: -5px;
		}
		#search_Gudang{
			width: 300px;
			height: 26px;
			border: none;
			font-size: 14px;
			box-shadow: 0px 0px 7px #AAAAAA;
			border-radius: 50px;
			text-align: center;
			margin-bottom: 10px;
			margin-top: -5px;
		}
		#Mutasi{
		  position: fixed;
		  z-index: 1000;
		  bottom: -300px; /* Position them outside of the screen */
		  transition: 0.6s; /* Add transition on hover */
		  width: 100%;
		  padding-top: 10px;
		  background-color: #182936;
		  border-radius: 70px 70px 0px 0px;

		  max-height: 40%;
		  overflow-y: auto;
		}
		#Mutasi::-webkit-scrollbar {
		  display: none;
		}
		#StockHouse{
		  position: fixed;
		  z-index: 1000;
		  bottom: -300px; /* Position them outside of the screen */
		  transition: 0.6s; /* Add transition on hover */
		  width: 100%;
		  padding-top: 10px;
		  background-color: #182936;
		  border-radius: 70px 70px 0px 0px;

		  max-height: 40%;
		  overflow-y: auto;
		}
		#StockHouse::-webkit-scrollbar {
		  display: none;
		}
		#Detail{
		  position: fixed;
		  z-index: 1000;
		  bottom: -340px; /* Position them outside of the screen */
		  transition: 0.6s; /* Add transition on hover */
		  width: 100%;
		  padding-top: 10px;
		  background-color: #182936;
		  border-radius: 70px 70px 0px 0px;

		  max-height: 40%;
		  overflow-y: auto;
		}
		#Detail::-webkit-scrollbar {
		  display: none;
		}
		.table{
			background-color: white;
			border-radius: 20px;
			color: #182936;
			border-color: white;
			border-width: 3px;
		}
		.table thead{
			border-radius: 20px 20px 0px 0px;
			font-size: 16px;
		}
		.table tbody{
			font-weight: bold;
			width: 100%;
		}
		.table tbody tr{
		}

		#mySidenav a{
		  position: fixed;
		  z-index: 100;
		  transition: 0.3s; /* Add transition on hover */
		  padding: 10px;
		  padding-left: 15px;
		  padding-top: 5px;
		  height: 50px;
		  text-decoration: none; /* Remove underline */
		  font-size: 16px; /* Increase font size */
		  border-radius: 12px 0px 0px 12px; /* Rounded corners on the top right and bottom right side */
		}
		#mySidenav a:hover {
		  right: 0; /* On mouse-over, make the elements appear as they should */
		}
		#SideNav_Stock{
		  top: 180px;
		  background-color: #182936;
		  width: 190px; /* Set a specific width */
		  right: -120px; /* Position them outside of the screen */
		}
		#SideNav_StockHouse{
		  top: 120px;
		  background-color: #182936;
		  width: 220px; /* Set a specific width */
		  right: -150px; /* Position them outside of the screen */
		}
		#SideNav_Mutasi{
		  top: 180px;
		  background-color: #182936;
		  width: 180px; /* Set a specific width */
		  right: -120px; /* Position them outside of the screen */
		}
		#SideNav_Detail{
		  top: 120px;
		  background-color: #182936;
		  width: 250px; /* Set a specific width */
		  right: -190px; /* Position them outside of the screen */
		}
		#SideNav_Proceed{
		  top: 180px;
		  background-color: #182936;
		  width: 160px; /* Set a specific width */
		  right: -100px; /* Position them outside of the screen */
		}
		#SideNav_PreOrder{
		  top: 240px;
		  background-color: #182936;
		  width: 200px; /* Set a specific width */
		  right: -130px; /* Position them outside of the screen */
		}

		
		
		#Notification{
			width: 8px;
			height: 8px;
			border-radius: 20px;
			background-color: red;
			position: relative;
			top: -25px;
			left: 23px;
		}
		#Mail_Modal{
			max-height: 70%;
			border-radius: 30px;
			overflow-y: auto;
		}
		#Mail_Modal::-webkit-scrollbar {
		  display: none;
		}
		.Mail{
			border-top: 2px solid #e5e5e5;
			margin-bottom: 5px;
			margin-top: 5px;
			color: #4fbbb2B0;
			font-size: 16px;
			text-align: left;
			text-decoration: none;
			outline: none !important;
			line-height: 22px;
			padding-top:10px;
			padding-bottom:10px;
		}
		.Mail:hover{
			color: #4fbbb2;
		}
		.Notif_Request{
			height: 60px;
			width: 60px;
			position: relative;
			left: 328px;
			top: -2px;
		}
		.Id_Request{
			font-weight: 500;
			font-size: 17px;
			margin-bottom: -20px;
		}
		.Date_Request{
			font-weight: 500;
			font-size: 17px;
			float: right;
			margin-right: 40px;
			margin-top: 14px;
		}
		.HealthCenter_Request{
			font-weight: 500;
		}
		.Item_Request{
			font-weight: 500;
		}
		.Info_Request{
			font-weight: 500;
		}
		.Qty_Request{
			font-weight: 500;
		}

		.btnPage{
			background-color: white;
			margin-left: 2px;
			margin-right: 2px;
		}

		.modalmodal{
			top: 11%;
		}
		.modalmodal .modal-content{
			width: 1300px;
			height: 650px;
		}

		.modalmodal .modal-body{
			width: 1300px;
		}

		.Modal_Date {
			align-content: center;
			text-align: center;
			margin: auto;
			color: white;
			border-radius: 20px;
			background-color: #4fbbb2B0;
			width: 150px;
			font-size: 14px;
			font-weight: 500;

			margin-top: -20px;
		}
		.Modal_Text{
			color: #4fbbb2;
			font-weight: 300;
			font-size: 17px;

			margin-left: 50px;
		}
		.Modal_Text2{
			font-weight: 500 !important;
		}
		.Modal_Table_Title{
			font-size: 18px;
			color: white;
			font-weight: 500;

			margin-bottom: 10px;
		}
		.Modal_Table_Container{
			background-color: #4fbbb2; 
			border-radius: 30px;
			margin-left: 50px; 
			margin-right: 50px;

			padding: 10px 20px 20px 20px;
		}
		#Modal_Table::-webkit-scrollbar {
		  display: none;
		}
		#Modal_Detail_Table::-webkit-scrollbar {
		  display: none;
		}
		#Modal_Mutation_Table::-webkit-scrollbar {
		  display: none;
		}
	</style>
</body>

</html>