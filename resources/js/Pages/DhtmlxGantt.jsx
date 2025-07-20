import React, { useEffect, useRef } from 'react';
import 'dhtmlx-gantt/codebase/dhtmlxgantt.css';
import gantt from 'dhtmlx-gantt';

const DhtmlxGantt = () => {
  const ganttContainer = useRef();

  useEffect(() => {
    gantt.config.xml_date = "%Y-%m-%d %H:%i";
    gantt.init(ganttContainer.current);

    gantt.parse({
      data: [
        { id: 1, text: "Phân tích yêu cầu", start_date: "2025-07-10", duration: 3, progress: 0.6 },
        { id: 2, text: "Thiết kế", start_date: "2025-07-13", duration: 3, progress: 0.4 },
        { id: 3, text: "Phát triển", start_date: "2025-07-16", duration: 5, progress: 0.2 }
      ],
      links: [
        { id: 1, source: 1, target: 2, type: "0" },
        { id: 2, source: 2, target: 3, type: "0" }
      ]
    });

    return () => {
      gantt.clearAll();
    };
  }, []);

  
  return (
    <div style={{ width: '100%', height: '500px' }} ref={ganttContainer}></div>
  );
};

export default DhtmlxGantt;
