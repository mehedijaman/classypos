
var app = angular.module('indexDBSample', []);
var Product=angular.module('myApp', []);

app.factory('indexedDBDataSvc', function($window, $q,$http){
  var indexedDB = $window.indexedDB;
  var db=null;
  var lastIndex=0;
  var TableIdentity=0;
  var CustomerIdentity=0;
  
  var open = function(){
    var deferred = $q.defer();
    var version = 1;
    var request = indexedDB.open("todoData", version);
  
    request.onupgradeneeded = function(e) {
      db = e.target.result;
  
      e.target.transaction.onerror = indexedDB.onerror;
  
      if(db.objectStoreNames.contains("Mapping")) {
        db.deleteObjectStore("Mapping");
      }

      if(db.objectStoreNames.contains("Customer")) {
        db.deleteObjectStore("Customer");
      }

      if(db.objectStoreNames.contains("CustomerTable")) {
        db.deleteObjectStore("CustomerTable");
      }
  
      var store = db.createObjectStore("Mapping",
        {keyPath: "id"});

      var Category = db.createObjectStore("Category",
        {keyPath: "Category"});

      //var Customer = db.createObjectStore("Customer",
        //{keyPath: "ID"});

      //var db = request.result;
      var store = db.createObjectStore("Customer", {keyPath: "CustomerID"});
      var storeTable = db.createObjectStore("CustomerTable", {keyPath: "TableID"});
      //var titleIndex = store.createIndex("by_title", "title", {unique: true});
      //var authorIndex = store.createIndex("by_author", "author");

      // for(i=0;i<10;i++)
      // {
      //   //store.put({Name: "Adnan", Address: "Fred",CustomerID:i});
      //   //store.put({Name: "Ashik", Address: "Fred",CustomerID: 234567});
      //   //store.put({Name: "Azhar", Address: "Barney",CustomerID: 345678});

      // }

      

      // var storeMapping = db.createObjectStore("Mapping",
      //    {keyPath: "id"});

    };

    


  
    request.onsuccess = function(e) {
      db = e.target.result;

      deferred.resolve();

      $http.get('/ServerRequest/GetData')
            .success(function (data, status, headers, config) {        
            var x=angular.fromJson(data);
            //alert("Total Number of Products"+x.length);
            //alert(x[0].ProductID);
            for(i=0;i<x.length;i++)
            addTodo(x[i].ProductID,x[i].Qty);
      });

      $http.get('/Sale/Customer/LocalStorage/')
      .success(function (data, status, headers, config) {        
      var x=angular.fromJson(data);
      //alert("Total Number of Customers"+x.length);
       //db = e.target.result;
      //var store = db.createObjectStore("Customer", {keyPath: "CustomerID"});
      //alert("I am Sakib");
      for(i=0;i<x.length;i++)
        addCustomer(x[i].FirstName,x[i].LastName);
        //addTodo(x[i].ProductID,x[i].Qty);
      });

      $http.get('/Sale/Table/LocalStorage/')
      .success(function (data, status, headers, config) {        
      var x=angular.fromJson(data);
      //alert("Total Number of Tables="+x.length);
       //db = e.target.result;
      //var store = db.createObjectStore("Customer", {keyPath: "CustomerID"});
      //alert("I am Sakib");
      for(i=0;i<x.length;i++)
      {
        //alert(x[i].Name);
        addTable(x[i].OrderID,x[i].Name);


      }
        //addTodo(x[i].ProductID,x[i].Qty);
      });
      //names=['Ali','Hasan','Hossain'];
      //alert("Angularjs call function on page load");
      //for(i=0;i<names.length;i++)
	     //addTodo(names[i]);
    };
  
    request.onerror = function(){
      deferred.reject();
    };
    // var request2 = indexedDB.open("todoData",2);
    // request2.onupgradeneeded = function(e) {
    //   db = e.target.result;  
    //   e.target.transaction.onerror = indexedDB.onerror;
  
    //   if(db.objectStoreNames.contains("Category")) {
    //     db.deleteObjectStore("Category");
    //   }

    //   var Category = db.createObjectStore("Category",
    //     {keyPath: "id"});
    // };
    // request2.onsuccess = function (e) {
    //         e.target.result.close();
    //     }


    return deferred.promise;
  };

  
  var getTodos = function(){
    var deferred = $q.defer();
    
    if(db === null){
      deferred.reject("IndexDB is not opened yet!");
    }
    else{
      var trans = db.transaction(["todo"], "readwrite");
      var store = trans.objectStore("todo");
      var todos = [];
    
      // Get everything in the store;
      var keyRange = IDBKeyRange.lowerBound(0);
      var cursorRequest = store.openCursor(keyRange);
    
      cursorRequest.onsuccess = function(e) {
        var result = e.target.result;
        if(result === null || result === undefined)
        {
          deferred.resolve(todos);
        }
        else{
          todos.push(result.value);
          if(result.value.id > lastIndex){
            lastIndex=result.value.id;
          }
          result.continue();
        }
      };
    
      cursorRequest.onerror = function(e){
        console.log(e.value);
        deferred.reject("Something went wrong!!!");
      };
    }
    
    return deferred.promise;
  };
  
  var deleteTodo = function(id){
    var deferred = $q.defer();
    
    if(db === null){
      deferred.reject("IndexDB is not opened yet!");
    }
    else{
      var trans = db.transaction(["todo"], "readwrite");
      var store = trans.objectStore("todo");
    
      var request = store.delete(id);
    
      request.onsuccess = function(e) {
        deferred.resolve();
      };
    
      request.onerror = function(e) {
        console.log(e.value);
        deferred.reject("Todo item couldn't be deleted");
      };
    }
    
    return deferred.promise;
  };
  
  var addTodo = function(ProductID,Qty){
    var deferred = $q.defer();
    
    if(db === null){
      deferred.reject("IndexDB is not opened yet!");
    }
    else{
      //alert("ProductID is:"+ProductID);
      var trans = db.transaction(["Mapping"], "readwrite");
      var store = trans.objectStore("Mapping");

      // var transCustomer = db.transaction(["Customer"], "readwrite");
      // var storeCustomer = transCustomer.objectStore("Customer");
      lastIndex++;


      // var requestCustomer = storeCustomer.put({
        
      //   "CustomerID":lastIndex,
      //   "Name":Alif
      //   //"text": todoText,
      //   //"Name":"Imran"
      // });


       // var shopproductmapping= db.transaction(["Mapping"], "readwrite");
       // var storemapping=shopproductmapping.objectStore("Mapping");

       // var requestmapping = storemapping.put({
       //    "id": 31,
       //    "name": "Zikra"
       //  });


      //alert("Index Number is:"+lastIndex);
      //if(lastIndex==1)
      //{
        var request = store.put({
        "id": lastIndex,
        "ProductID":ProductID,
        "Qty":Qty
        //"text": todoText,
        //"Name":"Imran"
      });

      //}
      
    
      request.onsuccess = function(e) {
        deferred.resolve();
      };
    
      request.onerror = function(e) {
        console.log(e.value);
        deferred.reject("Todo item couldn't be added!");
      };
    }
    return deferred.promise;
  };

  var addCustomer = function(FirstName,LastName){
    var deferred = $q.defer();
    
    if(db === null){
      deferred.reject("IndexDB is not opened yet!");
    }
    else{
      //alert("ProductID is:"+ProductID);
      var trans = db.transaction(["Customer"], "readwrite");
      var store = trans.objectStore("Customer");

      // var transCustomer = db.transaction(["Customer"], "readwrite");
      // var storeCustomer = transCustomer.objectStore("Customer");
      CustomerIdentity++;
      //alert(FirstName);


        var request = store.put({
        "CustomerID": CustomerIdentity,
        "FirstName":FirstName,
        "LastName":LastName
        //"text": todoText,
        //"Name":"Imran"
      });

      //}
      
    
      request.onsuccess = function(e) {
        deferred.resolve();
      };
    
      request.onerror = function(e) {
        console.log(e.value);
        deferred.reject("Todo item couldn't be added!");
      };
    }
    return deferred.promise;
  };

  var addTable = function(OrderID,Name){
    var deferred = $q.defer();
    
    
    if(db === null){
      deferred.reject("IndexDB is not opened yet!");
    }
    else{
      //alert("ProductID is:"+ProductID);
      var trans = db.transaction(["CustomerTable"], "readwrite");
      var store = trans.objectStore("CustomerTable");

      // var transCustomer = db.transaction(["Customer"], "readwrite");
      // var storeCustomer = transCustomer.objectStore("Customer");
      TableIdentity++;
      //alert(FirstName);


        var request = store.put({
        "TableID":TableIdentity,
        "OrderID": OrderID,
        "TableName":Name

        //"LastName":LastName
        //"text": todoText,
        //"Name":"Imran"
      });

      //}
      
    
      request.onsuccess = function(e) {
        deferred.resolve();
      };
    
      request.onerror = function(e) {
        console.log(e.value);
        deferred.reject("Todo item couldn't be added!");
      };
    }
    return deferred.promise;
  };

  return {
    open: open,
    getTodos: getTodos,
    addTodo: addTodo,
    deleteTodo: deleteTodo
  };
  
});

Product.controller('ProductAdd', ['$scope', function($scope) {
    //$scope.spice = 'very';

    $scope.GreatWork = function() {
        alert("Fahad is a Great Man");
    };

    // // $scope.jalapenoSpicy = function() {
    // //     $scope.spice = 'jalapeño';
    // };
}]);

app.controller('TodoController', function($window, indexedDBDataSvc){
  var vm = this;
  vm.todos=[];

	$window.onload = function() {
		
	

	};
  
  vm.refreshList = function(){
    indexedDBDataSvc.getTodos().then(function(data){
      vm.todos=data;
    }, function(err){
      $window.alert(err);
    });
  };
  
  vm.addTodo = function(){
    indexedDBDataSvc.addTodo(vm.todoText).then(function(){
      vm.refreshList();
      vm.todoText="";
    }, function(err){
      $window.alert(err);
    });
  };
  
  vm.deleteTodo = function(id){
    indexedDBDataSvc.deleteTodo(id).then(function(){
      vm.refreshList();
    }, function(err){
      $window.alert(err);
    });
  };
  
  function init(){
    indexedDBDataSvc.open().then(function(){
      vm.refreshList();
    });
  }
  
  init();
});