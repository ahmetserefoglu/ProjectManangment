 gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
  
  gantt.config.order_branch = true;
  gantt.config.order_branch_free = true;
  gantt.init("gantt_here");

  gantt.load("/api/v1/data");

  
  var dp = new gantt.dataProcessor("/api/v1");
  dp.init(gantt);
  dp.setTransactionMode("REST");
