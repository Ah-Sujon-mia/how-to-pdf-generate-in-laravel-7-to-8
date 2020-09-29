public function PostPdf(){
    $PostPdf = Post::all();
    $pdf = PDF::loadView('post-pdf', compact('PostPdf'));
    return $pdf->download('post-list.pdf');
}