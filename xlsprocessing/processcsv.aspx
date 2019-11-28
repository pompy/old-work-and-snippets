<%@ Page Language="C#" %>
<%@ Import Namespace="System.Data.OleDb" %>
<%@ Import Namespace="System.Data" %>
<%@ Import Namespace="System" %>


<script language="C#" runat="server">
protected void Page_Load(Object Src, EventArgs E)
{
String FilePath;
FilePath = Server.MapPath ( "" );

Response.Write(FilePath);

string strConn;
strConn = "Provider=Microsoft.Jet.OLEDB.4.0;" +
"Data Source=" + FilePath + ";" +
"Extended Properties=\"Text;HDR=YES;FMT=Delimited\"";
//You must use the $ after the object you reference in the spreadsheet
OleDbDataAdapter myCommand = new OleDbDataAdapter("SELECT * FROM D_W_80036893_999998_20100801.txt",strConn);

DataSet myDataSet = new DataSet();
myCommand.Fill(myDataSet, "ExcelInfo");
DataGrid1.DataSource = myDataSet.Tables["ExcelInfo"].DefaultView;
DataGrid1.DataBind();

}
</script>
<html>
<head></head>
<body>
<p><asp:Label id=Label1 runat="server">SpreadSheetContents:</asp:Label></p>
<asp:DataGrid id=DataGrid1 runat="server"/>\
</body>
</html>