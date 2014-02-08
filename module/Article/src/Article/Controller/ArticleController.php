<?php

namespace Article\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Article\Model\Article;
use Article\Form\ArticleForm;

class ArticleController extends AbstractActionController
{
    protected $articleTable;
    
    public function getArticleTable()
    {
        if (!$this->articleTable) {
            $sm = $this->getServiceLocator();
            $this->articleTable = $sm->get('Article\Model\ArticleTable');
        }
        return $this->articleTable;
    }
    
    
    public function indexAction()
    {
        return new ViewModel(array(
            'articles' => $this->getArticleTable()->getAllArticles(),
        ));
    }
    
    public function addAction()
    {
        $form = new ArticleForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $article = new Article();
            $form->setInputFilter($article->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $article->exchangeArray($form->getData());
                $this->getArticleTable()->saveArticle($article);

                return $this->redirect()->toRoute('article');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('article', array('action' => 'add'));
        }
        $article = $this->getArticleTable()->getArticle($id);

        $form  = new ArticleForm();
        $form->bind($article);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($article->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getArticleTable()->saveArticle($form->getData());

                return $this->redirect()->toRoute('article');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('article');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Nein');

            if ($del == 'Ja') {
                $id = (int) $request->getPost('id');
                $this->getArticleTable()->deleteArticle($id);
            }

            // Redirect to list of articles
            return $this->redirect()->toRoute('article');
        }

        return array(
            'id'    => $id,
            'article' => $this->getArticleTable()->getArticle($id)
        );
    }
}
