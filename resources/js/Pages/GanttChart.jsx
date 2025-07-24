import React, { useEffect, useState } from "react";
import gantt from "dhtmlx-gantt";
import "dhtmlx-gantt/codebase/dhtmlxgantt.css";
import AppLayout from "../Layouts/AppLayout";

export default function GanttChart({ datas }) {



  useEffect(() => {
    gantt.plugins({
      resource: true,
      zoom: true,
    });

    gantt.clearAll(); // Clear if already loaded

    gantt.config.xml_date = "%Y-%m-%d %H:%i";
    gantt.config.duration_unit = "hour";
    gantt.config.duration_step = 1;

    // Cấu hình resource view: gắn task với thiết bị
    gantt.config.resource_store = "resource";
    gantt.config.resource_property = "device_id";

    // layout với resource grouping trong timeline
    gantt.config.layout = {
      css: "gantt_container",
      rows: [
        {
          cols: [
            { view: "grid", group: "resource", width: 300, scrollY: "scrollVer" },
            { resizer: true },
            { view: "timeline", scrollX: "scrollHor", scrollY: "scrollVer" },
            { view: "scrollbar", id: "scrollVer" },
          ],
        },
        { view: "scrollbar", id: "scrollHor" },
      ],
    };


gantt.attachEvent("onEmptyClick", function (e, coords) {
  const date = gantt.dateFromPos(e.clientX);
  const y = coords.y;

  const resourceRows = gantt.getDatastore("resource").getItems();
  const rowHeight = gantt.config.row_height;
  const rowIndex = Math.floor(y / rowHeight);
  const resource = resourceRows[rowIndex];

  if (resource) {
    setSelectedTime(date);
    setSelectedDevice(resource);
    setShowModal(true);
  }
  console.log (resource)

  return true;
});

    // Cột hiển thị thiết bị
    gantt.config.columns = [
      { name: "text", label: "Thiết Bị", tree: true, width: 200 },
    ];

    // Hiển thị tên mẫu trên task
    gantt.templates.task_text = (start, end, task) => `${task.text}`;

    // Cấu hình zoom
    gantt.ext.zoom.init({
      levels: [
        {
          name: "hour",
          scale_height: 60,
          min_column_width: 30,
          scales: [
            { unit: "day", step: 1, format: "%d %M" },
            { unit: "hour", step: 1, format: "%H:%i" },
          ],
        },
        {
          name: "day",
          scale_height: 60,
          min_column_width: 80,
          scales: [
            { unit: "week", step: 1, format: "Tuần %W" },
            { unit: "day", step: 1, format: "%d %M" },
          ],
        },
        {
          name: "week",
          scale_height: 60,
          min_column_width: 50,
          scales: [
            { unit: "month", step: 1, format: "%F" },
            { unit: "week", step: 1, format: "Tuần %W" },
          ],
        },
        {
          name: "month",
          scale_height: 60,
          min_column_width: 120,
          scales: [
            { unit: "year", step: 1, format: "%Y" },
            { unit: "month", step: 1, format: "%F" },
          ],
        },
      ],
      useKey: "ctrlKey",
      trigger: "wheel",
    });

    // Khởi tạo và load data
    gantt.init("gantt_here");

    gantt.parse({
      data: datas.tasks,
      collections: {
        resource: datas.resources,
      },
    });

    gantt.ext.zoom.setLevel("hour");

    return () => {
      gantt.clearAll();
    };
  }, [datas]);

  return (
    <div>
      <div className="mb-2 space-x-2">
        <button onClick={() => gantt.ext.zoom.setLevel("hour")} className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Giờ</button>
        <button onClick={() => gantt.ext.zoom.setLevel("day")} className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Ngày</button>
        <button onClick={() => gantt.ext.zoom.setLevel("week")} className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Tuần</button>
        <button onClick={() => gantt.ext.zoom.setLevel("month")} className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Tháng</button>
      </div>
      <div id="gantt_here" style={{ width: "100%", height: "500px" }}></div>
    </div>

    
  );
}

GanttChart.layout = (page) => (
  <AppLayout title={page.props.title} user={page.props.user}>
    {page}
  </AppLayout>
);
