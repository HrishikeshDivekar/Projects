import java.util.ArrayList;

public class Range{
    public static  int[] range(int start,int end,int jumper){ //    Three Arguments
        ArrayList<Integer> ar = new ArrayList<>();
        if(start<end && jumper>0){
                for (int i = start; i < end; i += jumper) {
                    ar.add(i);
                }
        }
        if(start<end && jumper<0){
                ar.add(null);
        }
        if(start>end && jumper<0){
            for( int i=start;i>end;i+=jumper){
                ar.add(i);
            }
        }
        if(start>end && jumper>0){
            ar.add(null);
        }
        int[] arr = new int[ar.size()];
        for(int i=0;i<ar.size();i++){
            arr[i]=ar.get(i);
        }
        return arr;
    }
    public static int[] range(int start,int end){ //    Two arguments
        int[] arr = new int[Math.abs(end-start)];
        if(start<end) {
            for (int i = start, p = 0; i < end; i++, p++) {
                arr[p] = i;
            }
        }
        if(start>end){
            for (int i = start, p = 0; i > end; i--, p++) {
                arr[p] = i;
            }
        }
        return arr;
    }
    public static int[] range(int till){ //    One Argument
        int[] arr= new int[till];
        for(int i=0;i<till;i++){
            arr[i]=i;
        }
        return arr;
    }
}
