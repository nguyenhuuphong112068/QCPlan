import React, { useState } from 'react';
import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { Tag } from 'primereact/tag';
import { InputText } from 'primereact/inputtext';
import { Dropdown } from 'primereact/dropdown';




export default function MaterialTable() {
    const sampleData = [
        {
            id: 1,
            code: 'MAT001',
            code_SOP: 'SOP-A01',
            prepareBy: 'John Doe',
            active: true,
            tests: [{}, {}],
            product_name: {
                name: 'Product Alpha',
                shortName: 'Alpha',
                productType: 'A',
                active: true,
            }
        },
        {
            id: 2,
            code: 'MAT002',
            code_SOP: 'SOP-B02',
            prepareBy: 'Jane Smith',
            active: false,
            tests: [{}],
            product_name: {
                name: 'Product Beta',
                shortName: 'Beta',
                productType: 'B',
                active: false,
            }
        },
        {
            id: 3,
            code: 'MAT003',
            code_SOP: 'SOP-C03',
            prepareBy: 'Alice Nguyen',
            active: true,
            tests: [],
            product_name: {
                name: 'Product Gamma',
                shortName: 'Gamma',
                productType: 'C',
                active: true,
            }
        }
    ];

    const [categories, setCategories] = useState(sampleData);

    const productTypeOptions = [
        { label: 'A', value: 'A' },
        { label: 'B', value: 'B' },
        { label: 'C', value: 'C' }
    ];

    const onRowEditComplete = (e) => {
        const updatedData = [...categories];
        updatedData[e.index] = e.newData;
        setCategories(updatedData);
    };

    // Utility to get/set nested values
    const getNestedValue = (obj, path) => path.split('.').reduce((o, p) => o?.[p], obj);
    const setNestedValue = (obj, path, value) => {
        const keys = path.split('.');
        const lastKey = keys.pop();
        const lastObj = keys.reduce((o, k) => (o[k] ??= {}), obj);
        lastObj[lastKey] = value;
    };

    const textEditor = (options) => (
        <InputText
            type="text"
            value={options.value}
            onChange={(e) => options.editorCallback(e.target.value)}
        />
    );

    const nestedTextEditor = (field) => (options) => (
        <InputText
            type="text"
            value={getNestedValue(options.rowData, field)}
            onChange={(e) => {
                const updatedRow = { ...options.rowData };
                setNestedValue(updatedRow, field, e.target.value);
                options.editorCallback(updatedRow);
            }}
        />
    );

    const nestedDropdownEditor = (field, optionsList) => (options) => (
        <Dropdown
            value={getNestedValue(options.rowData, field)}
            options={optionsList}
            onChange={(e) => {
                const updatedRow = { ...options.rowData };
                setNestedValue(updatedRow, field, e.value);
                options.editorCallback(updatedRow);
            }}
            placeholder="Select"
        />
    );

    const activeStatusTemplate = (rowData) => (
        <Tag value={rowData.active ? 'Active' : 'Inactive'} severity={rowData.active ? 'success' : 'danger'} />
    );

    const productActiveTemplate = (rowData) => {
        const isActive = rowData.product_name?.active;
        return <Tag value={isActive ? 'Active' : 'Inactive'} severity={isActive ? 'success' : 'danger'} />;
    };

    const testCountTemplate = (rowData) => rowData.tests?.length ?? 0;

    return (

        
        <div className="card">
            <topNAV user={mockUser} />
            <leftNAV />

            <div className="font-sans text-xl mb-3">Material Category Table (Editable)</div>
            <DataTable
                value={categories}
                editMode="row"
                dataKey="id"
                onRowEditComplete={onRowEditComplete}
                tableStyle={{ minWidth: '80rem' }}
                paginator
                rows={10}
            >
                <Column field="code" header="Code" editor={textEditor} style={{ width: '10%' }} />
                <Column field="code_SOP" header="SOP Code" editor={textEditor} style={{ width: '10%' }} />
                <Column field="prepareBy" header="Prepared By" editor={textEditor} style={{ width: '15%' }} />
                <Column
                    field="product_name.name"
                    header="Product Name"
                    body={(row) => row.product_name?.name}
                    editor={nestedTextEditor("product_name.name")}
                    style={{ width: '15%' }}
                />
                <Column
                    field="product_name.shortName"
                    header="Short Name"
                    body={(row) => row.product_name?.shortName}
                    editor={nestedTextEditor("product_name.shortName")}
                    style={{ width: '10%' }}
                />
                <Column
                    field="product_name.productType"
                    header="Product Type"
                    body={(row) => row.product_name?.productType}
                    editor={nestedDropdownEditor("product_name.productType", productTypeOptions)}
                    style={{ width: '10%' }}
                />
                <Column header="Product Active" body={productActiveTemplate} style={{ width: '10%' }} />
                <Column header="Test Count" body={testCountTemplate} style={{ width: '10%' }} />
                <Column header="Material Active" body={activeStatusTemplate} style={{ width: '10%' }} />
                
                <Column
                    rowEditor
                    headerStyle={{ width: '10%', minWidth: '8rem' }}
                    bodyStyle={{ textAlign: 'center' }}
                />
            </DataTable>
        </div>
    );
}
