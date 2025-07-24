import React from 'react';
import { createRoot } from 'react-dom/client';
import GanttChart from './Pages/GanttChart';

const root = createRoot(document.getElementById('react-gantt'));
root.render(<GanttChart />);
