<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:255',
            'product_price' => 'required|numeric',
            'product_desc' => 'required',
            'product_content' => 'required',
            'category_id' => 'required|integer',
            'product_status' => 'required|boolean',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm.',
            'product_price.required' => 'Vui lòng nhập giá sản phẩm.',
            'product_price.numeric' => 'Giá sản phẩm phải là số.',
            'product_desc.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'product_content.required' => 'Vui lòng nhập nội dung sản phẩm.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'product_image.image' => 'Vui lòng tải lên một hình ảnh hợp lệ.',
            'product_image.mimes' => 'Hình ảnh phải là định dạng jpeg, png, jpg, gif hoặc svg.',
            'product_image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ];
    }
}
