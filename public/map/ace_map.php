<?php
$Ace=array();
$Ace['ADA 95 (gnat 5.1)']='ada';
$Ace['Assembler (nasm 2.11.05)']='assembly_x86';
$Ace['Assembler GC (g++ 5.1)']='assembly_x86';
$Ace['Awk (gawk-4.1.1)']='non';////////////////
$Ace['Bash (bash-4.3.33)']='non';/////////////
$Ace['Brainf**k (bff 1.0.5)']='non';//////////////////
$Ace['C (clang 3.7)']='c_cpp';
$Ace['C (gcc 5.1)']='c_cpp';
$Ace['C# (gmcs 4.0.2)']='csharp';
$Ace['C++ (clang 3.7)']='c_cpp';
$Ace['C++ (g++ 4.3.2)']='c_cpp';
$Ace['C++ (g++ 5.1)']='c_cpp';
$Ace['C++14 (g++ 5.1)']='c_cpp';
$Ace['C99 strict (gcc 5.1)']='c_cpp';
$Ace['Clips (clips 6.24)']='lisp';
$Ace['Clojure (clojure 1.7)']='clojure';
$Ace['Cobol (opencobol 1.1)']='cobol';
$Ace['Common Lisp (clisp 2.49)']='lisp';
$Ace['Common Lisp (sbcl 1.2.12)']='lisp';
$Ace['D (dmd 2.067.1)']='d';
$Ace['D (ldc 3.7)']='d';
$Ace['D (gdc 5.1)']='d';
$Ace['Elixir (1.1.0)']='elixir';
$Ace['F# (fsharp 3.1)']='non';//////
$Ace['Fantom (1.0.67)']='non';//////
$Ace['Fortran 95 (gfortran 5.1)']='fortran';
$Ace['Go (gc 1.4.2)']='golang';
$Ace['Groovy (2.4.4)']='groovy';
$Ace['Haskell (ghc 7.8)']='haskell';
$Ace['Icon (iconc 9.4.3)']='non';/////
$Ace['Intercal (ick 0.28-4)']='non';////
$Ace['JAR (JavaSE 6)']='non';//////////
$Ace['Java (JavaSE 8u51)']='java';
$Ace['JavaScript (spidermonkey 24.)']='javascript';
$Ace['Lua (luac 5.2)']='lua';
$Ace['Nemerle (ncc 0.9.3)']='non';///////
$Ace['Nice (nicec 0.9.13)']='non';//////
$Ace['Nim (nim 0.11.2)']='non';///////
$Ace['ObjC (clang 3.7)']='objectivec';
$Ace['ObjC (gcc 5.1)']='objectivec';
$Ace['Ocaml (ocamlopt 4.01.0)']='ocaml';
$Ace['Pascal (gpc 20070904)']='pascal';
$Ace['Pascal (fpc 2.6.4)']='pascal';
$Ace['Perl (perl 5.20.1)']='perl';
$Ace['PHP (php 5.6.9)']='php';
$Ace['PicoLisp (3.1.1)']='non';////////
$Ace['Pike (pike 7.8)']='non';///////
$Ace['Prolog (swipl 7.2)']='prolog';
$Ace['Python (python 2.7.10)']='python';
$Ace['Python (PyPy 2.6)']='python';
$Ace['Python 3 (python 3.4)']='python';
$Ace['Python 3 nbc (python 3.2.3 nbc)']='python';
$Ace['Python3.4 (Python 3.4)']='python';
$Ace['Ruby (ruby 2.1)']='ruby';
$Ace['Rust (1.0.0)']='rust';
$Ace['Scala (scala 2.11.7)']='scala';
$Ace['Scheme (chicken 4.9)']='scheme';
$Ace['Scheme (stalin 0.11)']='scheme';
$Ace['Scheme (guile 2.0.11)']='scheme';
$Ace['Sed (sed-4.2)']='non';/////////////
$Ace['Smalltalk (gst 3.2.4)']='non';//////////
$Ace['Tcl (tclsh 8.6)']='tcl';
$Ace['TECS ()']='tex';
$Ace['Text (plain text)']='text';
$Ace['Whitespace (wspace 0.3)']='non';//////////
$Ace['GNU GCC 5.1.0']='c_cpp';
$Ace['GNU GCC C11 5.1.0']='c_cpp';
$Ace['GNU G++ 5.1.0']='c_cpp';
$Ace['GNU G++11 5.1.0']='c_cpp';
$Ace['Microsoft Visual C++ 2010']='c_cpp';
$Ace['C# Mono 3.12.1.0']='csharp';
$Ace['MS C# .NET 4.0.30319']='csharp';
$Ace['D DMD32 v2.068.2']='d';
$Ace['Go 1.5.1']='golang';
$Ace['Haskell GHC 7.8.3']='haskell';
$Ace['Java 1.7.0_80']='java';
$Ace['Java 1.8.0_66']='java';
$Ace['OCaml 4.02.1']='ocaml';
$Ace['Delphi 7']='non';///////////
$Ace['Free Pascal 2.6.4']='pascal';
$Ace['Perl 5.20.1']='perl';
$Ace['PHP 5.4.42']='php';
$Ace['Python 2.7.10']='python';
$Ace['Python 3.5.0']='python';
$Ace['PyPy 2.7.10 (2.6.1)']='python';
$Ace['PyPy 3.2.5 (2.4.0)']='python';
$Ace['Ruby 2.0.0p645']='ruby';
$Ace['Scala 2.11.7']='scala';
$Ace['JavaScript V8 4.8.0']='javascript';
$Ace['ANSI C 5.3.0']='non';///////////////
$Ace['JAVA 1.8.0']='java';
$Ace['C++ 5.3.0']='c_cpp';
$Ace['PASCAL 3.0.0']='pascal';
$Ace['C++11 5.3.0']='c_cpp';
$Ace['PYTH3 3.5.1']='python';
if(isset($_POST['lang']))
{
	$x=0;
	for($i=0;$i<strlen($_POST["lang"]);$i++)
	{
		if(is_numeric($_POST["lang"][$i]))$x++;
		else break;
	}
	$_POST["lang"]=substr($_POST["lang"],$x,strlen($_POST["lang"]));
	
	if(isset($Ace[$_POST['lang']]))
	{
		echo $Ace[$_POST['lang']];
		exit;
	}
}
?>